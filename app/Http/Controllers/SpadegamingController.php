<?php

namespace App\Http\Controllers;

class SpadegamingController extends FrontendController
{
    public function index()
    {
        $title = 'SPADEGAMING';
        $resp = $this->apiGet('games', ['provider' => 'SPADEGAMING', 'category' => 'slot']);
        $gamelist = $resp['data'] ?? [];
        $gamelist = json_decode(json_encode($gamelist));
        $data = $this->fetchPage('slots');
        return view('gamelist', array_merge(compact('title', 'gamelist'), $data));
    }
}
