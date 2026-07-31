<?php

namespace App\Http\Controllers;

class EvoplayController extends FrontendController
{
    public function index()
    {
        $title = 'EVOPLAY';
        $resp = $this->apiGet('games', ['provider' => 'EVOPLAY', 'category' => 'slot']);
        $gamelist = $resp['data'] ?? [];
        $gamelist = json_decode(json_encode($gamelist));
        $data = $this->fetchPage('slots');
        return view('gamelist', array_merge(compact('title', 'gamelist'), $data));
    }
}
