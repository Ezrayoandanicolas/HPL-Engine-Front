<?php

namespace App\Http\Controllers;

class Cq9Controller extends FrontendController
{
    public function index()
    {
        $title = 'CQ9';
        $resp = $this->apiGet('games', ['provider' => 'CQ9', 'category' => 'slot']);
        $gamelist = $resp['data'] ?? [];
        $gamelist = json_decode(json_encode($gamelist));
        $data = $this->fetchPage('slots');
        return view('gamelist', array_merge(compact('title', 'gamelist'), $data));
    }
}
