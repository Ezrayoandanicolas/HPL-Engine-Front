<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardSettingController extends BaseAdminController
{
    public function index(Request $request)
    {
        $resp = $this->adminGet('games', [
            'provider' => $request->input('provider'),
            'category' => $request->input('category'),
        ]);
        $Game = $resp['data'] ?? [];

        $provResp = $this->adminGet('providers');
        $provider = $provResp['data']['providers'] ?? [];

        if (empty($provider)) {
            $provider = [
                ['provider_code' => 'PRAGMATIC', 'provider_name' => 'Pragmatic Play'],
                ['provider_code' => 'PGSOFT', 'provider_name' => 'PG Soft'],
                ['provider_code' => 'HABANERO', 'provider_name' => 'Habanero'],
                ['provider_code' => 'CQ9', 'provider_name' => 'CQ9'],
                ['provider_code' => 'JOKER', 'provider_name' => 'Joker Gaming'],
                ['provider_code' => 'PLAYSTAR', 'provider_name' => 'Playstar'],
                ['provider_code' => 'BOONGO', 'provider_name' => 'Booongo'],
                ['provider_code' => 'MICROGAMING', 'provider_name' => 'Microgaming'],
                ['provider_code' => 'PP', 'provider_name' => 'Pragmatic Play'],
                ['provider_code' => 'SPADEGAMING', 'provider_name' => 'Spade Gaming'],
                ['provider_code' => 'DREAMTECH', 'provider_name' => 'Dreamtech'],
                ['provider_code' => 'EVOPLAY', 'provider_name' => 'Evoplay'],
                ['provider_code' => 'TOPTREND', 'provider_name' => 'Toptrend'],
                ['provider_code' => 'PLAYNGO', 'provider_name' => 'Play N Go'],
                ['provider_code' => 'HACKSAW', 'provider_name' => 'Hacksaw'],
                ['provider_code' => 'GENESIS', 'provider_name' => 'Genesis'],
                ['provider_code' => 'ADVANTPLAY', 'provider_name' => 'Advant Play'],
            ];
        }

        return view('backoffice.games.game_setting', compact('Game', 'provider'));
    }

    public function edit(string $id)
    {
        $resp = $this->adminGet("games/{$id}");
        $game = $resp['data']['game'] ?? null;
        if (!$game) abort(404);
        return view('Dashboard.Game.edit', ['Game' => (object) $game]);
    }

    public function update(Request $request, string $id)
    {
        $this->adminPut("games/{$id}", $request->all());
        return redirect('/Admin/Dashboard/Game-Setting')->with('success', 'Game updated!');
    }

    public function searchByProvider(Request $request)
    {
        $resp = $this->adminGet('games/search-by-provider', ['provider_id' => $request->provider_id]);
        return response()->json($resp);
    }

    public function show($id)
    {
        $resp = $this->adminGet("games/{$id}");
        $game = $resp['data']['game'] ?? null;
        if (!$game) {
            return response()->json(['error' => 'Not found'], 404);
        }
        return response()->json(['game' => $game]);
    }
}
