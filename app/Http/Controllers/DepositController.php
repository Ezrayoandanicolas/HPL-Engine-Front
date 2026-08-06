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
            'img' => 'nullable|image|mimes:jpeg,png,jpg|max:2024',
        ]);

        $multipart = [];
        foreach ($request->except('_token', '_method') as $key => $value) {
            if ($request->hasFile($key)) {
                $multipart[] = [
                    'name' => $key,
                    'contents' => fopen($request->file($key)->getPathname(), 'r'),
                    'filename' => $request->file($key)->getClientOriginalName(),
                ];
            } elseif ($value !== null) {
                $multipart[] = ['name' => $key, 'contents' => $value];
            }
        }
        if (Auth::check()) {
            $multipart[] = ['name' => 'user_id', 'contents' => Auth::id()];
        }

        $response = $this->api->postMultipart('deposits', $multipart);

        if ($response['success'] ?? false) {
            return redirect('/deposit')->with('success', 'Deposit Berhasil');
        }
        return back()->with('error', $response['message'] ?? 'Deposit Gagal');
    }

    public function createQris(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Unauthenticated'], 401);
        }

        $request->validate([
            'amount' => 'required|numeric|min:0.01',
        ]);

        $response = $this->api->post('qris/deposit', [
            'amount' => $request->amount,
        ]);

        return response()->json($response);
    }

    public function checkQris(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Unauthenticated'], 401);
        }

        $request->validate(['trx_id' => 'required|string']);

        $response = $this->api->post('qris/check', [
            'trx_id' => $request->trx_id,
        ]);

        return response()->json($response);
    }
}
