<?php

namespace App\Http\Controllers;

class AdvantplayController extends FrontendController
{
    public function index()
    {
        $title = 'ADVANTPLAY';
        $resp = $this->apiGet('games', ['provider' => 'AD', 'category' => 'SL']);
        $gamelist = $resp['data'] ?? [];
        $gamelist = json_decode(json_encode($gamelist));
        $data = $this->fetchPage('slots');
        return view('gamelist', array_merge(compact('title', 'gamelist'), $data));
    }
}
