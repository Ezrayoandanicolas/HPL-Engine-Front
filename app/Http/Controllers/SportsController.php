<?php

namespace App\Http\Controllers;

class SportsController extends FrontendController
{
    public function index()
    {
        $title = 'SPORTS';

        $gamelist = $this->apiGet('sports/games', ['status' => 1]);

        if (!is_array($gamelist)) {
            $gamelist = [];
        }

        foreach ($gamelist as &$game) {
            $game = (object) $game;
            $game->image_url = trim($game->image_url ?? '');
            $game->img        = $game->image_url;
            $game->image      = $game->image_url;
            $game->images     = $game->image_url;
            $game->logo       = $game->image_url;
            $game->icon       = $game->image_url;
            $game->thumbnail  = $game->image_url;
            $game->game_image = $game->image_url;
            $game->picture    = $game->image_url;
        }
        unset($game);

        $data = $this->fetchPage('slots');
        return view('gamelist', array_merge(compact('title', 'gamelist'), $data));
    }
}
