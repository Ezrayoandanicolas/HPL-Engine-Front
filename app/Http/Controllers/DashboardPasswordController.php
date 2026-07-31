<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardPasswordController extends BaseAdminController
{
    public function index(Request $request)
    {
        $resp = $this->adminGet('users', ['search' => $request->input('search')]);
        $users = $resp['data']['users']['data'] ?? [];
        return view('Dashboard.Password.index', [
            'users' => $users,
            'userrefDeposite' => [],
        ]);
    }

    public function edit(string $id)
    {
        $resp = $this->adminGet("users/{$id}");
        $User = $resp['data']['user'] ?? null;
        if (!$User) abort(404);
        return view('Dashboard.Password.edit', ['User' => (object) $User]);
    }

    public function update(Request $request, $id)
    {
        $this->adminPut("users/{$id}", $request->only(['password']));
        return redirect('/Admin/Dashboard/Password')->with('success', 'Password updated successfully.');
    }

    public function destroy(string $id)
    {
        $this->adminDelete("users/{$id}");
        return redirect('/Admin/Dashboard/Password')->with('success', 'Deleted!');
    }
}
