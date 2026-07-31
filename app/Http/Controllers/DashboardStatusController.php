<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardStatusController extends BaseAdminController
{
    public function index()
    {
        $resp = $this->adminGet('statuses');
        $Status = $resp['data']['statuses'] ?? [];
        return view('Dashboard.Status_Tranksaksi.index', compact('Status'));
    }

    public function create()
    {
        return view('Dashboard.Status_Tranksaksi.create');
    }

    public function store(Request $request)
    {
        $this->adminPost('statuses', $request->all());
        return redirect('/Admin/Dashboard/Status')->with('success', 'Status created!');
    }

    public function edit($id)
    {
        $resp = $this->adminGet("statuses/{$id}");
        $status = $resp['data']['status'] ?? null;
        if (!$status) abort(404);
        return view('Dashboard.Status_Tranksaksi.edit', ['Status' => (object) $status]);
    }

    public function update(Request $request, $id)
    {
        $this->adminPut("statuses/{$id}", $request->all());
        return redirect('/Admin/Dashboard/Status')->with('success', 'Updated!');
    }

    public function destroy($id)
    {
        $this->adminDelete("statuses/{$id}");
        return redirect('/Admin/Dashboard/Status')->with('success', 'Deleted!');
    }
}
