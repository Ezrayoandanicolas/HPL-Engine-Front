<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function index()
    {
        return view('adminlogin');
    }

    public function auth(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            session(['api_user' => $user->toArray()]);

            if (Auth::user()->role == 'cashier') {
                return redirect('/cashier/dashboard');
            }
            return redirect('/Admin/Dashboard');
        }
        return back()->with('error', 'Login tidak berhasil!!');
    }
}
