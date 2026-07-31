<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardWarnaController extends BaseAdminController
{
    public function index()
    {
        $resp = $this->adminGet('colors');
        $warna = $resp['data']['colors'] ?? [];
        return view('Dashboard.Warna.index', compact('warna'));
    }

    public function create()
    {
        return view('Dashboard.Warna.create');
    }

    public function store(Request $request)
    {
        $this->adminPost('colors', $request->all());
        return redirect('/Admin/Dashboard/Warna')->with('success', 'Color created!');
    }

    public function destroy(string $id)
    {
        $this->adminDelete("colors/{$id}");
        return redirect('/Admin/Dashboard/Warna')->with('success', 'Deleted!');
    }
}
