<?php

namespace App\Http\Controllers;

class DreamtechController extends FrontendController
{
    public function index()
    {
        $title = 'DREAMTECH';
        $resp = $this->apiGet('games', ['provider' => 'DREAMTECH', 'category' => 'slot']);
        $gamelist = $resp['data'] ?? [];
        $gamelist = json_decode(json_encode($gamelist));
        $data = $this->fetchPage('slots');
        return view('gamelist', array_merge(compact('title', 'gamelist'), $data));
    }
}
