<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminLoginController extends BaseAdminController
{
    public function index()
    {
        return view('adminlogin');
    }

    public function auth(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $response = $this->api->post('auth/login', [
            'username' => $request->username,
            'password' => $request->password,
        ]);

        if (!$response['success']) {
            return back()->with('error', 'Username atau password salah.');
        }

        $userData = $response['data']['user'] ?? null;
        if (!$userData || !isset($userData['id'])) {
            return back()->with('error', 'Gagal login.');
        }

        $role = $userData['role'] ?? '';
        if (!in_array($role, ['admin', 'cashier', 'promotor'])) {
            return back()->with('error', 'Akun member tidak bisa login di panel admin.');
        }

        session([
            'api_token' => $response['data']['token'] ?? null,
            'api_user' => $userData,
        ]);
        $request->session()->regenerate();

        if ($role === 'cashier') {
            return redirect('/cashier/dashboard');
        }
        return redirect('/Admin/Dashboard');
    }
}
