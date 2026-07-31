<?php

namespace App\Http\Controllers;

class CasinoController extends FrontendController
{
    public function index()
    {
        $data = $this->fetchPage('casino');
        return view('casino', $data);
    }

    public function provider($provider)
    {
        $title = strtoupper($provider);
        $data = $this->fetchPage('game/' . $provider);
        return view('gamelist', array_merge(compact('title'), $data));
    }
}
