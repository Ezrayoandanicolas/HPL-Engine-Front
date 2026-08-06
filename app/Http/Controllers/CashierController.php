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
}
