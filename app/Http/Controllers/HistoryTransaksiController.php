<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HistoryTransaksiController extends FrontendController
{
    public function index()
    {
        $resp = $this->apiGet('transactions/deposits-completed');
        $deposits = collect($resp['data']['transactions']['data'] ?? [])->map(fn($d) => json_decode(json_encode($d)));

        $respW = $this->apiGet('transactions/withdraws-completed');
        $withdraws = collect($respW['data']['transactions']['data'] ?? [])->map(fn($w) => json_decode(json_encode($w)));

        return view('backoffice.histori_transaksi.histori_transaksi', compact('deposits', 'withdraws'));
    }

    public function getDepositHistory()
    {
        $resp = $this->apiGet('transactions/deposits-completed');
        $deposits = collect($resp['data']['transactions']['data'] ?? [])->map(fn($d) => json_decode(json_encode($d)));
        return response()->json($deposits);
    }

    public function getWithdrawHistory()
    {
        $resp = $this->apiGet('transactions/withdraws-completed');
        $withdraws = collect($resp['data']['transactions']['data'] ?? [])->map(fn($w) => json_decode(json_encode($w)));
        return response()->json($withdraws);
    }

    public function getBankName(Request $request)
    {
        $response = $this->apiGet('banks');
        return response()->json($response);
    }
}