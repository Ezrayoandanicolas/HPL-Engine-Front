<?php

namespace App\Http\Controllers;

class PlaystarController extends FrontendController
{
    public function index()
    {
        $title = 'PLAYSTAR';
        $resp = $this->apiGet('games', ['provider' => 'PS', 'category' => 'SL']);
        $gamelist = $resp['data'] ?? [];
        $gamelist = json_decode(json_encode($gamelist));
        $data = $this->fetchPage('slots');
        return view('gamelist', array_merge(compact('title', 'gamelist'), $data));
    }
}
