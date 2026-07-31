<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardWithdrawController extends BaseAdminController
{
    public function index(Request $request)
    {
        $resp = $this->adminGet('withdraws', [
            'status_id' => $request->input('status_id', 1),
            'search'    => $request->input('search'),
            'date_from' => $request->input('date_from'),
            'date_to'   => $request->input('date_to'),
        ]);
        $trans = $resp['data']['transactions']['data'] ?? [];

        return view('backoffice.withdraw.withdraw', [
            'Tranksaksi' => $trans,
        ]);
    }

    public function newWithdraws(Request $request)
    {
        $sinceId = $request->input('since_id', 0);
        $resp = $this->adminGet('withdraws-new', [
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
        $resp = $this->adminGet("withdraws-old/{$id}");
        $wd = $resp['data']['withdraw'] ?? null;
        if (!$wd) abort(404);
        $Tranksaksi = (object) $wd;
        return view('Dashboard.Withdraw.edit', compact('Tranksaksi'));
    }

    public function update(Request $request, $id)
    {
        $this->adminPost("withdraws/{$id}/update", ['action' => $request->input('action')]);
        return redirect('/Admin/Dashboard/Withdraw')->with('success', 'Post has been Updated!!');
    }

    public function destroy($id)
    {
        $this->adminDelete("withdraws-old/{$id}");
        return redirect('/Admin/Dashboard/Tranksaksi')->with('success', 'Deleted!');
    }
}
