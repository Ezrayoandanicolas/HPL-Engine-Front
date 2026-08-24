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
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

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

        // Selalu pastikan aas_user_code tersimpan untuk seamless callback
        if (!Auth::user()->aas_user_code) {
            $createRaw = $apiClient->create($username);
            $createResult = json_decode($createRaw, true);
            $aasCode = $createResult['aas_user_code'] ?? null;
            if ($aasCode) {
                $api->post('user/update-aas-code', ['aas_user_code' => $aasCode]);
            }
        }

        // User belum terdaftar di provider, buat otomatis lalu coba launch lagi
        $msg = $result['msg'] ?? ($result['code'] ?? '');
        if (in_array($msg, ['INVALID_USER', 'USER_NOT_FOUND'], true)) {
            $createRaw = $apiClient->create($username);
            $createResult = json_decode($createRaw, true);
            $aasCode = $createResult['aas_user_code'] ?? null;
            if ($aasCode) {
                $api->post('user/update-aas-code', ['aas_user_code' => $aasCode]);
            }
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

        $altGamesResp = $api->get('public-games', ['limit' => 8]);
        $altGames = collect($altGamesResp['data'] ?? [])->reject(fn($g) => ($g->id ?? 0) == ($game->id ?? 0))->values()->all();

        return view('game-maintenance', compact('game', 'setting', 'errorMsg', 'altGames'));
    }
}
