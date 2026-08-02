<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class MessageController extends FrontendController
{
    public function index()
    {
        $data = $this->fetchPage('home');
        $transactions = $this->apiGet('transactions/today-with-status');
        $transaksi = $transactions['transaksi'] ?? [];
        $damount = $transactions['damount'] ?? 'N/A';
        $wamount = $transactions['wamount'] ?? 'N/A';
        $transaksi = json_decode(json_encode($transaksi));
        $resp = $this->apiGet('admin/messages', ['recipient_id' => Auth::id()]);
        $adminMessages = $resp['data'] ?? [];
        return view('message', array_merge(compact('transaksi', 'wamount', 'damount', 'adminMessages'), $data));
    }

    public function show($id)
    {
        $this->apiPost('transactions/mark-read-single', ['id' => $id]);
        $data = $this->fetchPage('home');
        $transactions = $this->apiGet('transactions/show-with-summary', ['id' => $id]);
        $transaksi = $transactions['transaksi'] ?? [];
        $damount = $transactions['damount'] ?? 'N/A';
        $wamount = $transactions['wamount'] ?? 'N/A';
        $transaksi = json_decode(json_encode($transaksi));
        $resp = $this->apiGet('admin/messages', ['recipient_id' => Auth::id()]);
        $adminMessages = $resp['data'] ?? [];
        return view('show_message', array_merge(compact('transaksi', 'wamount', 'damount', 'adminMessages'), $data));
    }
}
