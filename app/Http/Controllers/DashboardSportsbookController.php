<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardSportsbookController extends Controller
{
    public function index()
    {
        return view('backoffice.sportsbook.index');
    }
}
