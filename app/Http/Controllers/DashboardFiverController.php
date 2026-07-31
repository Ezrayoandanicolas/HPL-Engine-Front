<?php

namespace App\Http\Controllers;

use App\Http\API\fiver;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class DashboardFiverController extends BaseAdminController
{
    protected $fiver;

    public function __construct()
    {
        parent::__construct();
        $this->fiver = new fiver();
    }

    public function index(Request $request)
    {
        $agentBalance = $this->getAgentBalance();

        $params = [];
        if ($search = $request->search) $params['search'] = $search;
        if ($status = $request->status) $params['status'] = $status;
        $params['page'] = (int) $request->page ?: 1;

        $resp = $this->api->get('admin/provider-transactions', $params);

        $items = array_map(function ($tx) {
            return (object) $tx;
        }, $resp['data'] ?? []);

        $transactions = new LengthAwarePaginator(
            $items,
            $resp['pagination']['total'] ?? 0,
            $resp['pagination']['per_page'] ?? 20,
            $resp['pagination']['current_page'] ?? 1,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        $counts = $resp['counts'] ?? [];
        $totalSuccess = (int) ($counts['success'] ?? 0);
        $totalFailed = (int) ($counts['failed'] ?? 0);

        return view('backoffice.fiver.index', compact('agentBalance', 'transactions', 'totalSuccess', 'totalFailed'));
    }

    public function resetUser(Request $request)
    {
        $request->validate(['username' => 'required|string']);

        $resp = $this->adminPost('fiver/reset-user', ['username' => $request->username]);

        $result = [
            'success' => !empty($resp['success']),
            'message' => $resp['message'] ?? 'Gagal',
            'data'    => $resp['data'] ?? null,
        ];

        return back()->with(
            $result['success'] ? 'success' : 'error',
            $result['message']
        )->with('result_data', $result['data']);
    }

    public function resetAll()
    {
        $resp = $this->adminPost('fiver/reset-balance');

        $result = [
            'success' => !empty($resp['success']),
            'message' => $resp['message'] ?? 'Gagal',
            'data'    => $resp['data'] ?? null,
        ];

        return back()->with(
            $result['success'] ? 'success' : 'error',
            $result['message']
        )->with('result_data', $result['data']);
    }

    public function checkStatus(Request $request)
    {
        $request->validate([
            'username'  => 'required|string',
            'agent_sign' => 'required|string',
        ]);

        $resp = $this->adminPost('fiver/check-status', [
            'username' => $request->username,
            'agent_sign' => $request->agent_sign,
        ]);

        $result = [
            'success' => !empty($resp['success']),
            'message' => $resp['message'] ?? 'Gagal',
            'data'    => $resp['data'] ?? null,
        ];

        return back()->with(
            $result['success'] ? 'success' : 'error',
            $result['message']
        )->with('result_data', $result['data']);
    }

    public function detailTransaction($id)
    {
        $resp = $this->api->get("admin/provider-transactions/{$id}");
        $tx = $resp['data'] ?? null;

        if (!$tx) {
            abort(404);
        }

        return view('backoffice.fiver.detail', ['tx' => (object) $tx]);
    }

    private function getAgentBalance(): ?float
    {
        $raw = $this->fiver->agentbalance();
        $decoded = json_decode($raw, true);

        if ($decoded && isset($decoded['status']) && (int) $decoded['status'] === 1) {
            return (float) ($decoded['balance'] ?? 0);
        }

        return null;
    }
}
