<?php

namespace App\Http\Controllers;

class MicrogamingController extends FrontendController
{
    public function index()
    {
        $title = 'MICROGAMING';
        $resp = $this->apiGet('games', ['provider' => 'MP', 'category' => 'SL']);
        $gamelist = $resp['data'] ?? [];
        $gamelist = json_decode(json_encode($gamelist));
        $data = $this->fetchPage('slots');
        return view('gamelist', array_merge(compact('title', 'gamelist'), $data));
    }
}
