<?php

namespace App\Http\Controllers;

class SlotController extends FrontendController
{
    public function index()
    {
        $data = $this->fetchPage('slots');
        return view('slot', $data);
    }
}
