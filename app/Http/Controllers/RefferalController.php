<?php

namespace App\Http\Controllers;

use Endroid\QrCode\QrCode;
use Illuminate\Http\Request;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RefferalController extends FrontendController
{
    public function index()
    {
        $data = $this->fetchPage('home');
        $verifikasi = $this->apiGet('referral/verifikasi');
        return view('referral', array_merge(compact('verifikasi'), $data));
    }

    public function reffVerif()
    {
        $data = $this->fetchPage('home');
        return view('refferal_verif', $data);
    }

    public function submitReferralVerification(Request $request)
    {
        $user = Auth::user();
        $qrCodeContent = strval($user->ref);

        $validateData = $request->validate([
            'fullName' => 'required|max:100|regex:/^[0-9a-zA-Z ]*$/',
            'img' => 'required|mimes:png,jpeg,jpg|max:5120',
            'terms' => 'required|accepted',
        ]);

        $payload = $request->all();

        if ($request->file('img')) {
            $payload['img'] = $request->file('img')->store('post-images');
        }

        $qrCode = new QrCode($qrCodeContent);
        $writer = new PngWriter();
        $qrCodeData = $writer->write($qrCode);

        $filename = 'qrcode_' . $user->id . '_' . time() . '.png';
        $barcodePath = 'post-images/' . $filename;

        $saved = Storage::put($barcodePath, $qrCodeData->getString());

        if ($saved) {
            $payload['barcode'] = $barcodePath;
        } else {
            return redirect()->back()->withErrors(['msg' => 'Failed to save QR code image.']);
        }

        $response = $this->apiPost('referral/submit-verification', $payload);

        if (isset($response['success'])) {
            return redirect()->back()->with('success', 'Verifikasi referral berhasil.');
        }

        return redirect()->back()->withErrors(['msg' => 'Gagal menyimpan verifikasi.']);
    }


    public function getReferralData(Request $request)
    {
        $response = $this->apiGet('referral/data');
        return response()->json($response);
    }

    public function getReferralDetails()
    {
        $response = $this->apiGet('referral/details');
        return response()->json($response);
    }
}
