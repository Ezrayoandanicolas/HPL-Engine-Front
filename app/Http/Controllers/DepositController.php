<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepositController extends FrontendController
{
    public function index()
    {
        if (!Auth::check()) return redirect('/');
        $data = $this->fetchPage('deposit');
        return view('deposit', $data);
    }

    public function store(Request $request)
    {
        if (!Auth::check()) return redirect('/');
        $request->validate([
            'bankMember' => 'required|max:255',
            'amount' => 'required',
            'img' => 'image|file|mimes:jpeg,png,jpg|max:2024',
        ]);
        $payload = $request->all();
        if ($request->file('img')) {
            $payload['img'] = $request->file('img')->store('post-images');
        } else {
            $payload['img'] = NULL;
        }
        $response = $this->apiPost('deposits', $payload);
        if (isset($response['success'])) {
            return redirect('/deposit')->with('success', 'Deposit Berhasil');
        }
        return back()->with('error', $response['message'] ?? 'Deposit Gagal');
    }
}
