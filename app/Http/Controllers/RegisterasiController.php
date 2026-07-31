<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class RegisterasiController extends FrontendController
{
    public function index()
    {
        $data = $this->fetchPage('home');
        return view('layout.mobile.registerasi', $data);
    }

    public function loadReferral(Request $request)
    {
        $data = $this->fetchPage('home');

        if (isset($request->ref)) {

            $referral = $request->ref;
            $response = $this->apiGet('user/by-ref', ['ref' => $referral]);

            if ($response && isset($response['user'])) {
                return view('layout.mobile.registerasi', array_merge(compact('referral'), $data));
            }

            return view('404');
        }

        return back()->with('info', 'Invalid referral code');
    }

    public function registerasi(Request $request)
    {
        $refferalcode = Str::random(6);
        $domain = URL::to('/');
        $Url = $domain . '/referral-register?ref=' . $refferalcode;

        $request->validate([
            'username'   => 'required|regex:/^[0-9a-zA-Z]{3,12}$/',
            'password'   => 'required|min:8|max:20|regex:/^(?=.*[a-z])(?=.*[0-9]).*$/|confirmed',
            'email'      => 'required|email',
            'phone'      => 'required',
            'accNumber'  => 'required',
            'accName'    => 'required|regex:/^[0-9a-zA-Z ]*$/',
            'bank'       => 'required',
            'country'    => 'required',
            'informasi'  => 'required',
            'whatsapp'   => 'required',
        ], [
            'username.regex' => 'Nama pengguna harus terdiri dari 3-12 karakter.',
            'password.regex' => 'Password harus mengandung huruf dan angka.',
        ]);

        $response = $this->apiPost('auth/register', array_merge(
            $request->all(),
            ['ref_code' => $refferalcode, 'ref_link' => $Url]
        ));

        if (isset($response['success'])) {
            return redirect('/')
                ->with('success', 'Registrasi Berhasil. Silahkan Login');
        }

        return back()->with('error', $response['message'] ?? 'Registrasi gagal');
    }
}
