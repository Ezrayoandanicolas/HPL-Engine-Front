<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardVoucherController extends BaseAdminController
{
    public function index(Request $request)
    {
        $resp = $this->adminGet('vouchers', [
            'search'    => $request->input('search'),
            'date_from' => $request->input('date_from'),
            'date_to'   => $request->input('date_to'),
        ]);
        $voucher = $resp['data']['vouchers'] ?? [];
        return view('backoffice.voucher.voucher', compact('voucher'));
    }

    public function store(Request $request)
    {
        $this->adminPost('vouchers', $request->all());
        return redirect('/Admin/Dashboard/Voucher');
    }

    public function destroy(string $id)
    {
        $this->adminDelete("vouchers/{$id}");
        return redirect('/Admin/Dashboard/Voucher');
    }
}
