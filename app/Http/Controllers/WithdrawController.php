<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WithdrawController extends FrontendController
{
    public function index()
    {
        if (!Auth::check()) return redirect('/');
        $data = $this->fetchPage('withdraw');
        $data['hiddenBalance'] = $data['saldo'] ?? (Auth::user()->saldo ?? 0);
        return view('withdraw', $data);
    }

    public function store(Request $request)
    {
        if (!Auth::check()) return redirect('/');
        $request->validate([
            'bankMember' => 'required',
            'amount' => 'required',
        ]);
        $response = $this->apiPost('withdraws', $request->all());
        if ($response['success'] ?? false) {
            return redirect('/withdraw')->with('success', 'Withdraw Berhasil');
        }
        return back()->with('error', $response['message'] ?? 'Withdraw gagal');
    }

    public function getWithdrawHistory(Request $request)
    {
        $history = $this->apiGet('withdraw/history');
        return response()->json(['data' => $history]);
    }

    public function getTodayWithdraw()
    {
        $response = $this->apiGet('withdraw/today');
        return response()->json($response);
    }
}
