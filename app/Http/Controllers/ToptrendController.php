<?php

namespace App\Http\Controllers;

class ToptrendController extends FrontendController
{
    public function index()
    {
        $title = 'TOPTREND';
        $resp = $this->apiGet('games', ['provider' => 'TOPTREND', 'category' => 'slot']);
        $gamelist = $resp['data'] ?? [];
        $gamelist = json_decode(json_encode($gamelist));
        $data = $this->fetchPage('slots');
        return view('gamelist', array_merge(compact('title', 'gamelist'), $data));
    }
}
