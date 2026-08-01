<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends FrontendController
{
    public function index()
    {
        if (!Auth::check()) return redirect('/');
        $data = $this->fetchPage('profile');
        $rekResp = $this->apiGet('rekening', ['user_id' => Auth::id()]);
        $data['rekening'] = !empty($rekResp['data']['rekening']) ? (object) $rekResp['data']['rekening'] : null;
        $data['damount'] = (float) optional($data['deposit'] ?? null)->amount;
        $data['wamount'] = (float) optional($data['withdraw'] ?? null)->amount;
        return view('profile', $data);
    }

    public function ubahProfile()
    {
        if (!Auth::check()) return redirect('/');
        $data = $this->fetchPage('profile');
        return view('edit_profile', $data);
    }

    public function update(Request $request)
    {
        if (!Auth::check()) return redirect('/');

        $response = $this->apiPost('profile/update', $request->only(
            'FullName', 'accName', 'noHp', 'ContactNo', 'WhatsApp', 'Country', 'Email'
        ));

        if (!$response['success'] ?? true) {
            return back()->with('error', $response['message'] ?? 'Gagal mengubah profile');
        }

        if (isset($response['data']['user'])) {
            session(['api_user' => array_merge(
                session('api_user', []),
                (array) $response['data']['user']
            )]);
        }

        return redirect('/profile')->with('success', 'Profile Berhasil Diubah');
    }

    public function changePassword()
    {
        if (!Auth::check()) return redirect('/');
        $data = $this->fetchPage('profile');
        return view('ubah_password', $data);
    }

    public function passwordBerubah(Request $request)
    {
        if (!Auth::check()) return redirect('/');
        $request->validate([
            'OldPassword' => 'required',
            'password' => 'required|min:6|confirmed',
            'VerificationCode' => 'required|captcha',
        ]);
        $response = $this->apiPost('profile/change-password', [
            'old_password' => $request->input('OldPassword'),
            'new_password' => $request->input('password'),
            'new_password_confirmation' => $request->input('password_confirmation'),
        ]);
        if (!$response['success'] ?? true) {
            return back()->with('error', $response['message'] ?? 'Gagal mengubah password');
        }
        return redirect('/profile')->with('success', 'Password Berhasil Diubah');
    }

    public function passwordHasChange(Request $request)
    {
        return $this->passwordBerubah($request);
    }
}
