<?php

namespace App\Http\Controllers;

class HacksawController extends FrontendController
{
    public function index()
    {
        $title = 'HACKSAW';
        $resp = $this->apiGet('games', ['provider' => 'HACKSAW', 'category' => 'slot', 'status' => 1]);
        $gamelist = $resp['data'] ?? [];
        $gamelist = json_decode(json_encode($gamelist));
        $data = $this->fetchPage('slots');
        return view('gamelist', array_merge(compact('title', 'gamelist'), $data));
    }
}
