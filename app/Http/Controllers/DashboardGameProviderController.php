<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardGameProviderController extends BaseAdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $resp = $this->adminGet('game-provider');
        $current = $resp['data']['provider'] ?? 'fiver';
        $label = $resp['data']['label'] ?? 'Fiver';

        $balancesResp = $this->adminGet('provider-balances');
        $balances = $balancesResp['data'] ?? [];

        return view('backoffice.game_provider.index', compact('current', 'label', 'balances'));
    }

    public function switch(Request $request)
    {
        $request->validate(['provider' => 'required|in:fiver,dc']);

        $resp = $this->adminPost('game-provider', ['provider' => $request->provider]);

        if (!empty($resp['success'])) {
            return back()->with('success', $resp['message'] ?? 'Provider game berhasil diganti');
        }

        return back()->with('error', $resp['message'] ?? 'Gagal mengganti provider game');
    }

    public function syncProviders()
    {
        $resp = $this->adminPost('sync-dc-providers');

        if (!empty($resp['success'])) {
            $data = $resp['data'] ?? [];
            $synced = (int) ($data['synced'] ?? 0);
            $total = (int) ($data['total'] ?? 0);
            return back()->with('success', "Sync DC providers berhasil: {$synced} baru dibuat dari total {$total}");
        }

        return back()->with('error', $resp['message'] ?? 'Gagal sync DC providers');
    }

    public function syncGames(Request $request)
    {
        $request->validate(['provider_code' => 'required|string']);

        $resp = $this->adminPost('sync-dc-games', ['provider_code' => strtoupper($request->provider_code)]);

        if (!empty($resp['success'])) {
            $data = $resp['data'] ?? [];
            $synced = (int) ($data['synced'] ?? 0);
            $total = (int) ($data['total'] ?? 0);
            return back()->with('success', "Sync DC games {$request->provider_code} berhasil: {$synced} dari {$total}");
        }

        return back()->with('error', $resp['message'] ?? 'Gagal sync DC games');
    }

    public function syncAllGames()
    {
        $resp = $this->adminPost('sync-all-dc-games');

        if (!empty($resp['success'])) {
            $data = $resp['data'] ?? [];
            $providers = (int) ($data['providers_synced'] ?? 0);
            $games = (int) ($data['total_games'] ?? 0);
            return back()->with('success', "Sync semua DC games berhasil: {$providers} provider, {$games} games");
        }

        return back()->with('error', $resp['message'] ?? 'Gagal sync semua DC games');
    }
}