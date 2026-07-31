<?php

namespace App\Http\Controllers;

class PragmaticplayController extends FrontendController
{
    public function index()
    {
        $title = 'PRAGMATICPLAY';
        $resp = $this->apiGet('games', ['provider' => 'PRAGMATIC', 'category' => 'slot']);
        $gamelist = $resp['data'] ?? [];
        $gamelist = json_decode(json_encode($gamelist));
        $data = $this->fetchPage('slots');
        return view('gamelist', array_merge(compact('title', 'gamelist'), $data));
    }
}
