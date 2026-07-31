<?php

namespace App\Http\Controllers;

class VoucherController extends BaseAdminController
{
    public function index()
    {
        $resp = $this->adminGet('vouchers');
        $voucher = $resp['data']['vouchers'] ?? collect();
        return view('layout.desktop.loyalitas', compact('voucher'));
    }

    public function store() {}
}
