<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardActivityController extends BaseAdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
        $resp = $this->adminGet('activity-logs', $request->only('action', 'admin_id', 'date_from', 'date_to'));
        $logs = $resp['data'] ?? [];
        return view('backoffice.activity.index', compact('logs'));
    }
}
