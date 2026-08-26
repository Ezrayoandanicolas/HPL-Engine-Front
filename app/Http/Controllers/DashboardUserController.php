<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardUserController extends BaseAdminController
{
    public function index(Request $request)
    {
        $resp = $this->adminGet('users', [
            'search' => $request->input('search'),
            'role'   => $request->input('role'),
            'per_page' => $request->input('per_page', 20),
        ]);
        $usersData = $resp['data']['users'] ?? [];
        $users = collect($usersData['data'] ?? [])->map(fn($u) => (object) $u);
        $searchTerm = $request->input('search');
        $selectedRole = $request->input('role');
        $currentPage = $usersData['current_page'] ?? 1;
        $lastPage = $usersData['last_page'] ?? 1;
        $total = $usersData['total'] ?? $users->count();
        $perPage = $usersData['per_page'] ?? 20;

        $bankResp = $this->adminGet('banks');
        $rekening = collect($bankResp['data']['banks'] ?? [])->map(fn($r) => (object) $r);

        return view('backoffice.data_member.data_member', [
            'users' => $users,
            'searchTerm' => $searchTerm,
            'selectedRole' => $selectedRole,
            'rekening' => $rekening,
            'currentPage' => $currentPage,
            'lastPage' => $lastPage,
            'total' => $total,
            'perPage' => $perPage,
        ]);
    }

    public function store(Request $request)
    {
        $this->adminPost('users', $request->all());
        return redirect('/Admin/Dashboard/User')->with('success', 'User berhasil ditambahkan!');
    }

    public function show($id)
    {
        $resp = $this->adminGet("users/{$id}");
        $user = $resp['data']['user'] ?? null;
        if (!$user) abort(404);
        $user = (object) $user;
        return view('backoffice.data_member.update', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $this->adminPut("users/{$id}", $request->all());
        return redirect()->back()->with('success', 'User updated successfully.');
    }
}
