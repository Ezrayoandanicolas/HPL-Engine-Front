<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardDepositeController extends BaseAdminController
{
    public function index(Request $request)
    {
        $resp = $this->adminGet('deposits', [
            'status_id' => $request->input('status_id', 1),
            'search'    => $request->input('search'),
            'date_from' => $request->input('date_from'),
            'date_to'   => $request->input('date_to'),
        ]);
        $trans = $resp['data']['transactions']['data'] ?? [];

        $depResp = $this->adminGet('deposites', [
            'search'    => $request->input('search'),
            'date_from' => $request->input('date_from'),
            'date_to'   => $request->input('date_to'),
        ]);
        $oldDepos = $depResp['data']['deposites'] ?? [];

        return view('backoffice.deposit.deposit', [
            'userrefDeposite' => $oldDepos,
            'Tranksaksi' => $trans,
        ]);
    }

    public function newDeposits(Request $request)
    {
        $sinceId = $request->input('since_id', 0);
        $resp = $this->adminGet('deposits-new', [
            'since_id'  => $sinceId,
            'status_id' => $request->input('status_id', 1),
        ]);
        $newTrans = $resp['data']['transactions'] ?? [];

        return response()->json([
            'transactions' => $newTrans,
        ]);
    }

    public function edit($id)
    {
        $resp = $this->adminGet("deposites/{$id}");
        $dep = $resp['data']['deposite'] ?? null;
        if (!$dep) abort(404);
        $Tranksaksi = (object) $dep;
        return view('Dashboard.Deposite.edit', compact('Tranksaksi'));
    }

    public function update(Request $request, $id)
    {
        $this->adminPost("deposits/{$id}/update", ['action' => $request->input('action')]);
        return redirect('/Admin/Dashboard/Tranksaksi')->with('success', 'Transaksi berhasil diupdate!');
    }

    public function destroy($id)
    {
        $this->adminDelete("deposites/{$id}");
        return redirect('/Admin/Dashboard/Tranksaksi')->with('success', 'Deleted!');
    }
}
