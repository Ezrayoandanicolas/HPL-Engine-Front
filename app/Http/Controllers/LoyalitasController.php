<?php

namespace App\Http\Controllers;

class LoyalitasController extends FrontendController
{
    public function index()
    {
        $data = $this->fetchPage('home');
        $voucher = $this->apiGet('vouchers/available');
        return view('loyalitas', array_merge(compact('voucher'), $data));
    }

    public function claimVoucher($voucherId)
    {
        $response = $this->apiPost('loyalitas/claim-voucher', ['voucher_id' => $voucherId]);
        if (isset($response['success'])) {
            return redirect('/loyalitas')->with('info', 'Berhasil diklaim');
        }
        return redirect()->back()->with('info', $response['message'] ?? 'Gagal mengklaim voucher');
    }

    public function tarik()
    {
        $this->apiPost('loyalitas/tarik', ['nominal' => '50000']);
    }
}
