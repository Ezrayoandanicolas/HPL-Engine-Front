<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\Request;

class AdminLogoutController extends Controller
{
    public function Logout(Request $request)
    {
        return $this->AdminLogout($request);
    }

    public function AdminLogout(Request $request)
    {
        $api = app(ApiService::class);
        $api->post('auth/logout');

        $request->session()->forget(['api_token', 'api_user']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Berhasil logout');
    }
}
