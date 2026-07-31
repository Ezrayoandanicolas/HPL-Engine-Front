<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HistoryTransaksiController extends FrontendController
{
    public function index()
    {
        $resp = $this->apiGet('transactions/deposits-completed');
        $deposits = collect($resp['data']['transactions']['data'] ?? [])->map(fn($d) => (object) $d);

        $respW = $this->apiGet('transactions/withdraws-completed');
        $withdraws = collect($respW['data']['transactions']['data'] ?? [])->map(fn($w) => (object) $w);

        return view('backoffice.histori_transaksi.histori_transaksi', compact('deposits', 'withdraws'));
    }

    public function getDepositHistory()
    {
        $resp = $this->apiGet('transactions/deposits-completed');
        $deposits = $resp['data']['transactions']['data'] ?? [];
        return response()->json($deposits);
    }

    public function getWithdrawHistory()
    {
        $resp = $this->apiGet('transactions/withdraws-completed');
        $withdraws = $resp['data']['transactions']['data'] ?? [];
        return response()->json($withdraws);
    }

    public function getBankName(Request $request)
    {
        $response = $this->apiGet('banks');
        return response()->json($response);
    }
}