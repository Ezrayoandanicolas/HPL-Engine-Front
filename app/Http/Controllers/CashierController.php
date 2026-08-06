<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CashierController extends BaseAdminController
{
    public function dashboard()
    {
        $response = $this->adminGet('dashboard');

        $depResp = $this->adminGet('deposits', ['status_id' => 1]);
        $wdResp = $this->adminGet('withdraws', ['status_id' => 1]);

        $data = $response['data'] ?? [];

        return view('backoffice.cashier.dashboard', [
            'totalDeposite' => $data['totalDeposit'] ?? 0,
            'totalWithdraw' => $data['totalWithdraw'] ?? 0,
            'totalUser' => $data['totalUser'] ?? 0,
            'pendingDeposite' => $data['pendingDeposit'] ?? 0,
            'pendingWithdraw' => $data['pendingWithdraw'] ?? 0,
            'totalPendapatan' => ($data['totalDeposit'] ?? 0) - ($data['totalWithdraw'] ?? 0),
            'Game' => $data['totalGame'] ?? 0,
            'pendingDeposits' => $depResp['data']['transactions'] ?? [],
            'pendingWithdraws' => $wdResp['data']['transactions'] ?? [],
        ]);
    }

    public function depositHistory(Request $request)
    {
        $resp = $this->adminGet('transactions/deposits-all', [
            'status_id' => $request->input('status_id'),
            'search'    => $request->input('search'),
            'date_from' => $request->input('date_from'),
            'date_to'   => $request->input('date_to'),
        ]);
        $deposits = collect($resp['data']['transactions']['data'] ?? [])
            ->map(fn($d) => json_decode(json_encode($d)));

        return view('backoffice.cashier.deposit_history', [
            'deposits' => $deposits,
            'status'   => $request->input('status_id'),
            'search'   => $request->input('search'),
        ]);
    }
}