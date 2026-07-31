<?php

namespace App\Http\Controllers;

class PlayngoController extends FrontendController
{
    public function index()
    {
        $title = 'PLAYNGO';
        $resp = $this->apiGet('games', ['provider' => 'PLAYNGO', 'category' => 'slot', 'status' => 1]);
        $gamelist = $resp['data'] ?? [];
        $gamelist = json_decode(json_encode($gamelist));
        $data = $this->fetchPage('slots');
        return view('gamelist', array_merge(compact('title', 'gamelist'), $data));
    }
}
