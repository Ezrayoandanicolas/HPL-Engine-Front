<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardStatisticController extends BaseAdminController
{
    public function index()
    {
        $resp = $this->adminGet('statistics');
        $stats = $resp['data'] ?? [];
        return view('backoffice.statistic.index', compact('stats'));
    }
}
