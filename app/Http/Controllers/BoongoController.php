<?php

namespace App\Http\Controllers;

class BoongoController extends FrontendController
{
    public function index()
    {
        $title = 'BOOONGO';
        $resp = $this->apiGet('games', ['provider' => 'BOOONGO', 'category' => 'slot']);
        $gamelist = $resp['data'] ?? [];
        $gamelist = json_decode(json_encode($gamelist));
        $data = $this->fetchPage('slots');
        return view('gamelist', array_merge(compact('title', 'gamelist'), $data));
    }
}
