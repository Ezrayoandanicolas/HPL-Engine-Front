<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RekeningController extends BaseAdminController
{
    public function index()
    {
        $userData = session('api_user');
        $userId = $userData['id'] ?? 0;

        $settingsResp = $this->adminGet('settings');
        $settingData = $settingsResp['data']['setting'] ?? [];
        $setting = (object) $settingData;

        $rekResp = $this->adminGet('rekening', ['user_id' => $userId]);
        $rekeningData = $rekResp['data']['rekening'] ?? null;
        $rekening = $rekeningData ? (object) $rekeningData : null;

        $balance = '0,00';

        return view('bank_user', compact('rekening', 'balance', 'setting'));
    }

    public function store(Request $request)
    {
        $userData = session('api_user');
        $userId = $userData['id'] ?? 0;

        $this->adminPost('rekening', [
            'user_id' => $userId,
            'bank' => $request->Bank,
            'accNumber' => $request->accNumber,
            'accName' => $request->accName,
        ]);

        return redirect()->back()->with('info', 'Akun bank berhasil ditambahkan.');
    }
}
