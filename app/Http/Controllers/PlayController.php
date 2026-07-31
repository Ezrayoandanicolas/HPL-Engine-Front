<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Services\ApiService;
use App\Http\API\fiver;

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

        $slotBalance = (float) Auth::user()->saldo_slot;
        if ($slotBalance <= 0) {
            return redirect()->route('transfer', [
                'from' => 'main', 'to' => 'slot'
            ])->with('warning', 'Saldo Slot kosong. Transfer dulu.');
        }

        $fiver = new fiver();
        $raw = $fiver->opengame(Auth::user()->username, $game->game_code, $game->game_provider);
        $result = json_decode($raw, true);

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
