<?php

namespace App\Http\Controllers;

class HabaneroController extends FrontendController
{
    public function index()
    {
        $title = 'HABANERO';
        $resp = $this->apiGet('games', ['provider' => 'HABANERO', 'category' => 'slot']);
        $gamelist = $resp['data'] ?? [];
        $gamelist = json_decode(json_encode($gamelist));
        $data = $this->fetchPage('slots');
        return view('gamelist', array_merge(compact('title', 'gamelist'), $data));
    }
}
