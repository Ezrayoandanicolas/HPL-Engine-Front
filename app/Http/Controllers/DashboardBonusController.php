<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardBonusController extends BaseAdminController
{
    public function index(Request $request)
    {
        $resp = $this->adminGet('bonuses', [
            'search' => $request->input('search'),
            'per_page' => 999,
        ]);
        $bonus = $resp['data'] ?? [];
        $bonus = collect($bonus);
        return view('backoffice.bonus.bonus', compact('bonus'));
    }

    public function store(Request $request)
    {
        $this->adminPost('bonuses', $request->only('judul', 'keterangan', 'nominal'));
        return redirect('/Admin/Dashboard/Bonus')->with('success', 'Bonus berhasil ditambahkan');
    }

    public function show($id)
    {
        $resp = $this->adminGet("bonuses/{$id}");
        $bonus = $resp['data']['bonus'] ?? null;
        if (!$bonus) {
            return response()->json(['error' => 'Not found'], 404);
        }
        return response()->json(['bonus' => $bonus]);
    }

    public function update(Request $request, $id)
    {
        $this->adminPost("bonuses/{$id}", $request->only('judul', 'keterangan', 'nominal'));
        return redirect('/Admin/Dashboard/Bonus')->with('success', 'Bonus berhasil diupdate');
    }

    public function destroy($id)
    {
        $this->adminDelete("bonuses/{$id}");
        return redirect('/Admin/Dashboard/Bonus')->with('success', 'Bonus berhasil dihapus');
    }

    public function toggleStatus($id)
    {
        $this->adminPost("bonuses/{$id}/toggle-status");
        return redirect('/Admin/Dashboard/Bonus')->with('success', 'Status bonus diubah');
    }
}
