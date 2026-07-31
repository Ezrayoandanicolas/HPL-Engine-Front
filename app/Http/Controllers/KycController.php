<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KycController extends BaseAdminController
{
    public function index(Request $request)
    {
        $resp = $this->adminGet('verifications', [
            'status' => $request->input('status', 'menunggu'),
            'search' => $request->input('search'),
        ]);
        $verifikasi = $resp['data']['verifications']['data'] ?? [];

        return view('backoffice.kyc.kyc', [
            'verifikasi' => $verifikasi,
        ]);
    }

    public function newVerifications(Request $request)
    {
        $sinceId = $request->input('since_id', 0);
        $resp = $this->adminGet('verifications-new', [
            'since_id' => $sinceId,
            'status'   => $request->input('status', 'menunggu'),
        ]);
        $newVerif = $resp['data']['verifications'] ?? [];

        return response()->json([
            'verifications' => $newVerif,
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        $this->adminPost("verifications/{$id}/update", ['action' => $request->action]);
        return redirect()->back()->with('success', 'KYC status updated successfully.');
    }
}