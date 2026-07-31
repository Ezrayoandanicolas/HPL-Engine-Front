<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InjectController extends BaseAdminController
{
    public function index(Request $request)
    {
        $resp = $this->adminGet('users', [
            'search' => $request->input('search'),
        ]);
        $user = $resp['data']['users']['data'] ?? [];

        return view('backoffice.data_member.inject', [
            'user' => $user,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'saldo' => 'required|numeric|min:0',
            'action' => 'required|in:add,subtract',
        ]);

        $resp = $this->adminPost("users/{$id}/inject-saldo", [
            'saldo' => $request->input('saldo'),
            'action' => $request->input('action'),
        ]);

        if (($resp['success'] ?? false)) {
            return redirect()->back()->with('success', 'Saldo berhasil diperbarui.');
        }

        return redirect()->back()->with('error', $resp['message'] ?? 'Gagal memperbarui saldo.');
    }
}