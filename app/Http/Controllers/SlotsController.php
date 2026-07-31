<?php

namespace App\Http\Controllers;

class SlotsController extends FrontendController
{
    public function index()
    {
        $title = 'SLOTS';
        $data = $this->fetchPage('slots');
        return view('gamelist', array_merge(compact('title'), $data));
    }

    public function provider($provider)
    {
        $title = strtoupper($provider);
        $resp = $this->apiGet('games', ['provider' => strtoupper($provider), 'category' => 'slot']);
        $gamelist = $resp['data'] ?? [];
        $gamelist = json_decode(json_encode($gamelist));
        $data = $this->fetchPage('slots');
        return view('gamelist', array_merge(compact('title', 'gamelist'), $data));
    }
}
