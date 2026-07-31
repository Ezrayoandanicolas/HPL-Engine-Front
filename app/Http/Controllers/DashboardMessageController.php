<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardMessageController extends BaseAdminController
{
    public function index(Request $request)
    {
        $resp = $this->adminGet('messages');
        $messages = $resp['data'] ?? [];

        $usersResp = $this->adminGet('users');
        $users = $usersResp['data']['users']['data'] ?? [];

        return view('backoffice.message.index', compact('messages', 'users'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'type' => 'required|in:broadcast,private',
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'recipient_id' => 'nullable|exists:users,id',
        ]);

        $this->adminPost('messages', $data);
        return redirect('/Admin/Dashboard/Message')->with('success', 'Pesan berhasil dikirim');
    }

    public function destroy($id)
    {
        $this->adminDelete("messages/{$id}");
        return redirect('/Admin/Dashboard/Message')->with('success', 'Pesan dihapus');
    }
}
