<?php

namespace App\Http\Controllers;

class ArcadeController extends FrontendController
{
    public function index()
    {
        $title = 'ARCADE';
        $resp = $this->apiGet('games', ['category' => 'FH']);
        $gamelist = $resp['data'] ?? [];
        $gamelist = json_decode(json_encode($gamelist));
        $data = $this->fetchPage('slots');
        return view('gamelist', array_merge(compact('title', 'gamelist'), $data));
    }
}
