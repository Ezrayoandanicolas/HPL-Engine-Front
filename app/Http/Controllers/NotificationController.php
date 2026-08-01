<?php

namespace App\Http\Controllers;

class NotificationController extends FrontendController
{
    public function promos()
    {
        $resp = $this->apiGet('claims/notifications');
        $data = $resp['data'] ?? $resp;
        return response()->json($data);
    }

    public function messages()
    {
        $resp = $this->apiGet('messages');
        $data = $resp['data'] ?? $resp;
        return response()->json($data);
    }
}
