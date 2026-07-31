<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DashboardLiveChatController extends BaseAdminController
{
    public function index()
    {
        return view('backoffice.livechat.index', [
            'apiBaseUrl' => rtrim(config('app.api_base_url', 'http://127.0.0.1:8001/api'), '/'),
            'apiKey' => config('app.api_key', ''),
        ]);
    }

    public function unreadCount()
    {
        try {
            $response = app(\App\Services\ApiService::class)->get('admin/chat/unread-count');
            $count = (int) ($response['count'] ?? 0);
        } catch (\Exception $e) {
            $count = 0;
        }

        return response()->json(['count' => $count]);
    }
}
