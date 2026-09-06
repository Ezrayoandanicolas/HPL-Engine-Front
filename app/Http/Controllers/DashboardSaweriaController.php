<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardSaweriaController extends BaseAdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view('backoffice.saweria.history');
    }

    public function transactions(Request $request)
    {
        $resp = $this->adminGet('saweria/transactions', $request->only(['page', 'page_size']));
        return response()->json($resp);
    }

    public function balance()
    {
        $resp = $this->adminGet('saweria/balance');
        return response()->json($resp);
    }
}
