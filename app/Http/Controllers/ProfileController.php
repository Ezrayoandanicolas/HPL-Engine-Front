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
        $request->validate([
            'accName' => 'required|max:255',
            'noHp' => 'nullable|max:255',
        ]);
        $response = $this->apiPost('profile/update', $request->only('accName', 'noHp'));
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
            'old_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);
        $response = $this->apiPost('profile/change-password', $request->only('old_password', 'new_password', 'new_password_confirmation'));
        if (isset($response['error'])) {
            return back()->with('error', $response['error']);
        }
        return redirect('/profile')->with('success', 'Password Berhasil Diubah');
    }

    public function passwordHasChange(Request $request)
    {
        return $this->passwordBerubah($request);
    }
}
