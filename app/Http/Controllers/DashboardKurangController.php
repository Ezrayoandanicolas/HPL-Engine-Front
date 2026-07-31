<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardKurangController extends BaseAdminController
{
    public function index(Request $request)
    {
        $resp = $this->adminGet('users', ['search' => $request->input('search')]);
        $users = $resp['data']['users']['data'] ?? [];
        return view('Dashboard.Kurang.index', [
            'users' => $users,
            'userrefDeposite' => [],
        ]);
    }

    public function edit($id)
    {
        $resp = $this->adminGet("users/{$id}");
        $User = $resp['data']['user'] ?? null;
        if (!$User) abort(404);
        return view('Dashboard.Kurang.edit', ['User' => (object) $User]);
    }

    public function update(Request $request, $id)
    {
        $resp = $this->adminPut("users/{$id}", ['saldo' => $request->saldo]);
        return redirect('/Admin/Dashboard/Kurang')->with('success', 'Saldo Berhasil Dikurang!!');
    }

    public function destroy($id)
    {
        $this->adminDelete("users/{$id}");
        return redirect('/Admin/Dashboard/Kurang')->with('success', 'Deleted!');
    }
}
