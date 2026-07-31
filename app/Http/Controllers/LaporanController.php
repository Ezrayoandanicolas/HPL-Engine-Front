<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends BaseAdminController
{
    public function store(Request $request)
    {
        $this->adminPost('laporans', $request->all());
        return back()->with('success', 'Pesan Berhasil Dikirim');
    }
}
