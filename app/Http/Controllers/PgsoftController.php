<?php

namespace App\Http\Controllers;

class PgsoftController extends FrontendController
{
    public function index()
    {
        $title = 'PGSOFT';
        $resp = $this->apiGet('games', ['provider' => 'PGSOFT', 'category' => 'slot']);
        $gamelist = $resp['data'] ?? [];
        $gamelist = json_decode(json_encode($gamelist));
        $data = $this->fetchPage('slots');
        return view('gamelist', array_merge(compact('title', 'gamelist'), $data));
    }
}
