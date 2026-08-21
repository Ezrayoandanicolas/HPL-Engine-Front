<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Services\ApiService;
use App\Http\API\fiver;
use App\Http\API\DigitalCreative;
use App\Http\API\XApi;

class PlayController extends Controller
{
    public function show($id)
    {
        $api = app(ApiService::class);
        $gameResp = $api->get("games/{$id}");
        $gameData = $gameResp['data']['game'] ?? null;
        if (!$gameData) {
            return back()->with('error', 'Game tidak ditemukan.');
        }
        $game = (object) $gameData;

        $providerResp = $api->get('admin/game-provider');
        $provider = $providerResp['data']['provider'] ?? 'fiver';

        $apiClient = match ($provider) {
            'dc' => new DigitalCreative(),
            'xapi' => new XApi(),
            default => new fiver(),
        };
        $username = Auth::user()->username;
        $raw = $apiClient->opengame($username, $game->game_code, $game->game_provider);
        $result = json_decode($raw, true);

        // User belum terdaftar di provider, buat otomatis lalu coba launch lagi
        $msg = $result['msg'] ?? ($result['code'] ?? '');
        if (in_array($msg, ['INVALID_USER', 'USER_NOT_FOUND'], true)) {
            $apiClient->create($username);
            $raw = $apiClient->opengame($username, $game->game_code, $game->game_provider);
            $result = json_decode($raw, true);
        }

        \Illuminate\Support\Facades\Log::info('GAME LAUNCH RESPONSE', ['raw' => $raw, 'parsed' => $result]);

        if ($result && isset($result['status']) && $result['status'] == 1) {
            $gameUrl = $result['launch_url'] ?? $result['url'] ?? $result['data']['url'] ?? null;
            if ($gameUrl) {
                return redirect()->away($gameUrl);
            }
        }

        $homeResp = $api->get('page/home');
        $homeData = $homeResp['data'] ?? [];
        $setting = (object) ($homeData['setting'] ?? []);
        $errorMsg = $result['msg'] ?? 'Gagal meluncurkan game';
        return view('game-maintenance', compact('game', 'setting', 'errorMsg'));
    }
}
