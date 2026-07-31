<?php

namespace App\Http\Controllers;

class JokerController extends FrontendController
{
    public function index()
    {
        $title = 'JOKER';
        $resp = $this->apiGet('games', ['provider' => 'JOKERGAMING', 'category' => 'slot', 'status' => 1]);
        $gamelist = $resp['data'] ?? [];
        $gamelist = json_decode(json_encode($gamelist));
        $data = $this->fetchPage('slots');
        return view('gamelist', array_merge(compact('title', 'gamelist'), $data));
    }
}
