<?php

namespace App\Http\Controllers;

use Endroid\QrCode\QrCode;
use Illuminate\Http\Request;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Auth;

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

        $qrCode = new QrCode($qrCodeContent);
        $writer = new PngWriter();
        $qrCodeData = $writer->write($qrCode);

        $filename = 'qrcode_' . $user->id . '_' . time() . '.png';

        $multipart = [
            ['name' => 'fullName', 'contents' => $request->input('fullName')],
            ['name' => 'terms', 'contents' => '1'],
            [
                'name' => 'img',
                'contents' => fopen($request->file('img')->getRealPath(), 'r'),
                'filename' => $request->file('img')->getClientOriginalName(),
            ],
            [
                'name' => 'barcode',
                'contents' => $qrCodeData->getString(),
                'filename' => $filename,
            ],
        ];

        $response = $this->api->postMultipart('referral/submit-verification', $multipart);

        if ($response['success'] ?? false) {
            return redirect()->back()->with('success', 'Verifikasi referral berhasil.');
        }

        return redirect()->back()->withErrors(['msg' => $response['message'] ?? 'Gagal menyimpan verifikasi.']);
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
