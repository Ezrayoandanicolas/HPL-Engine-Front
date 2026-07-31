<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasswordController extends BaseAdminController
{
    public function ubahPassword(Request $request)
    {
        $validate = $request->validate([
            'username' => 'required',
            'password' => 'required|min:8',
        ]);

        $resp = $this->adminPost('users/find-by-username', ['username' => $request->username]);

        if ($resp['success'] ?? false) {
            $user = $resp['data']['user'] ?? null;
            if ($user) {
                $this->adminPut("users/{$user['id']}", ['password' => $request->password]);
                return redirect('/')->with('success', 'Password Berhasil di Ubah');
            }
        }

        return back()->with('info', 'User Tidak Ditemukan');
    }
}
