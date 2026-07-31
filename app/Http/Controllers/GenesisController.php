<?php

namespace App\Http\Controllers;

class GenesisController extends FrontendController
{
    public function index()
    {
        $title = 'FASTSPIN';
        $resp = $this->apiGet('games', ['provider' => 'FASTSPIN', 'category' => 'slot']);
        $gamelist = $resp['data'] ?? [];
        $gamelist = json_decode(json_encode($gamelist));
        $data = $this->fetchPage('slots');
        return view('gamelist', array_merge(compact('title', 'gamelist'), $data));
    }
}
