<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TambahController extends BaseAdminController
{
    public function index(Request $request)
    {
        $resp = $this->adminGet('users', ['search' => $request->input('search')]);
        $users = $resp['data']['users']['data'] ?? [];

        return view('Dashboard.Tambah.index', [
            'users' => $users,
            'userrefDeposite' => [],
        ]);
    }

    public function edit(string $id)
    {
        $resp = $this->adminGet("users/{$id}");
        $User = $resp['data']['user'] ?? null;
        if (!$User) abort(404);

        $depResp = $this->adminGet('deposites');
        $deposites = $depResp['data']['deposites'] ?? [];
        $Deposite = array_values(array_filter($deposites, fn($d) => ($d['user_id'] ?? null) == $id && ($d['status_id'] ?? null) == 1));

        return view('Dashboard.Tambah.edit', [
            'User' => (object) $User,
            'Deposite' => $Deposite,
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->adminPut("users/{$id}", ['saldo' => $request->saldo]);
        return redirect('/Admin/Dashboard/Tambah')->with('success', 'Saldo Berhasil ditambah!!');
    }

    public function destroy($id)
    {
        $this->adminDelete("users/{$id}");
        return redirect('/Admin/Dashboard/Kurang')->with('success', 'Deleted!');
    }
}
