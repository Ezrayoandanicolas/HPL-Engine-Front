<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HistoryDepositController extends FrontendController
{
    public function index()
    {
        $data = $this->fetchPage('profile');
        return view('history_deposit', $data);
    }


    public function getDepositHistory(Request $request)
    {
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        $Deposits = $this->apiGet('deposit/history', [
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);

        return response()->json(['data' => $Deposits]);
    }

    public function getTodayDeposit()
    {
        $todayDeposits = $this->apiGet('deposit/today');
        return response()->json($todayDeposits);
    }


    public function getUnreadTransactionsCount()
    {
        $response = $this->apiGet('transactions/unread-count');
        return response()->json($response);
    }

    public function markAllTransactionsAsRead()
    {
        $response = $this->apiPost('transactions/mark-read');
        return response()->json($response);
    }

    public function getAllTransaksi()
    {
        $transaksi = $this->apiGet('transactions/today');
        return response()->json($transaksi);
    }
}
