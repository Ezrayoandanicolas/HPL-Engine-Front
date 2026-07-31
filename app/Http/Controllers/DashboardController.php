<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends BaseAdminController
{
    public function index(Request $request)
    {
        $response = $this->adminGet('dashboard');

        $usersResp = $this->adminGet('dashboard/users', ['search' => $request->input('search')]);
        $users = $usersResp['data']['users'] ?? collect();

        $balancesResp = $this->adminGet('provider-balances');
        $balances = $balancesResp['data'] ?? [];

        $data = $response['data'] ?? [];

        return view('backoffice.backoffice', [
            'User' => $users,
            'Deposite' => [],
            'totalDeposite' => $data['totalDeposit'] ?? 0,
            'totalWithdraw' => $data['totalWithdraw'] ?? 0,
            'totalUser' => $data['totalUser'] ?? 0,
            'pendingDeposite' => $data['pendingDeposit'] ?? 0,
            'pendingWithdraw' => $data['pendingWithdraw'] ?? 0,
            'totalPendapatan' => ($data['totalDeposit'] ?? 0) - ($data['totalWithdraw'] ?? 0),
            'totalref' => 0,
            'totalpendingrefDeposite' => 0,
            'userrefDeposite' => [],
            'totalrefDeposite' => 0,
            'agentBalance' => $balances['agentBalance'] ?? 0,
            'exaBalance' => $balances['exaBalance'] ?? 0,
            'Game' => $data['totalGame'] ?? 0,
        ]);
    }

    public function edit(string $id)
    {
        $response = $this->adminGet("users/{$id}");
        $user = $response['data']['user'] ?? null;
        if (!$user) abort(404);
        $User = (object) $user;
        return view('Dashboard.edit', compact('User'));
    }

    public function update(Request $request, string $id)
    {
        $this->adminPut("users/{$id}", $request->only(['bank', 'accNumber', 'accName']));
        return redirect('/Admin/Dashboard')->with('success', 'User Bank has been Updated!!');
    }

    public function approveDeposit($id)
    {
        $this->adminPost("deposits/{$id}/update", ['action' => 'acc']);
        return redirect()->back()->with('success', 'Deposit berhasil disetujui!');
    }

    public function approveWithdraw($id)
    {
        $this->adminPost("withdraws/{$id}/update", ['action' => 'acc']);
        return redirect()->back()->with('success', 'Withdraw berhasil disetujui!');
    }

    public function getDeposit()
    {
        return $this->adminGet('dashboard/today-deposits');
    }

    public function getWithdawDashboard()
    {
        return $this->adminGet('dashboard/today-withdraws');
    }

    public function unreadNotifications()
    {
        $depResp = $this->adminGet('deposits-new', ['since_id' => 0, 'status_id' => 1]);
        $wdResp = $this->adminGet('withdraws-new', ['since_id' => 0, 'status_id' => 1]);
        $deps = $depResp['data']['transactions'] ?? [];
        $wds = $wdResp['data']['transactions'] ?? [];
        $items = [];
        foreach ($deps as $d) {
            $items[] = ['type' => 'deposit', 'message' => 'Deposit Rp' . number_format($d['amount']??0,0) . ' oleh ' . ($d['user']['username']??'-'), 'time' => \Carbon\Carbon::parse($d['created_at']??now())->diffForHumans()];
        }
        foreach ($wds as $w) {
            $items[] = ['type' => 'withdraw', 'message' => 'Withdraw Rp' . number_format($w['amount']??0,0) . ' oleh ' . ($w['user']['username']??'-'), 'time' => \Carbon\Carbon::parse($w['created_at']??now())->diffForHumans()];
        }
        return response()->json(['data' => array_slice($items, 0, 10)]);
    }
}
