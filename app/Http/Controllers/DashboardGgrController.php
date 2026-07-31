<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardGgrController extends BaseAdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function balance()
    {
        $resp = $this->adminGet('ggr-users-balance');
        $users = $resp['data'] ?? [];
        return view('backoffice.ggr.balance', compact('users'));
    }
}
