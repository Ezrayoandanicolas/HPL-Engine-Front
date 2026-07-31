<?php

namespace App\Http\Controllers;

class PokerController extends FrontendController
{
    public function index()
    {
        $title = 'POKER';
        $resp = $this->apiGet('games', ['category' => 'PK']);
        $gamelist = $resp['data'] ?? [];
        $gamelist = json_decode(json_encode($gamelist));
        $data = $this->fetchPage('slots');
        return view('gamelist', array_merge(compact('title', 'gamelist'), $data));
    }
}
