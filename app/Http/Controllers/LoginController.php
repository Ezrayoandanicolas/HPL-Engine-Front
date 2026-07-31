<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends FrontendController
{
    public function index()
    {
        $data = $this->fetchPage('home');
        return view('layout.mobile.login', $data);
    }

    public function auth(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $response = $this->apiPost('auth/login', [
            'username' => $request->username,
            'password' => $request->password,
        ]);

        if (!$response['success']) {
            return back()->withErrors(['username' => 'Username atau Password salah.']);
        }

        $userData = $response['data']['user'] ?? null;
        if ($userData && isset($userData['id'])) {
            session([
                'api_token' => $response['data']['token'] ?? null,
                'api_user' => $userData,
            ]);
            $request->session()->regenerate();
            return redirect('/');
        }

        return back()->with('info', 'Login gagal, silahkan periksa kembali data Anda.');
    }

    public function logout(Request $request)
    {
        $this->apiPost('auth/logout');
        $request->session()->forget(['api_token', 'api_user']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Berhasil logout');
    }
}
