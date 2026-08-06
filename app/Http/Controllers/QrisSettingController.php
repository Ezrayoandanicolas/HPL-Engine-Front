<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QrisSettingController extends BaseAdminController
{
    public function index()
    {
        $resp = $this->adminGet('qris-settings');
        $settings = $resp['data'] ?? [];
        $accounts = $settings['accounts'] ?? [];
        $settings = json_decode(json_encode($settings));

        return view('backoffice.qris_setting.qris_setting', compact('settings', 'accounts'));
    }

    public function store(Request $request)
    {
        $data = $request->except('_token', '_method');
        $resp = $this->adminPost('qris-settings', $data);

        if (!($resp['success'] ?? false)) {
            $msg = $resp['message'] ?? 'Gagal menyimpan pengaturan QRIS';
            if (is_array($msg)) $msg = json_encode($msg);
            return redirect('/Admin/Dashboard/Qris-Setting')->with('error', $msg);
        }

        return redirect('/Admin/Dashboard/Qris-Setting')->with('success', 'Pengaturan QRIS Berhasil Disimpan!');
    }
}
