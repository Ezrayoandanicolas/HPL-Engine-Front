<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HistoryPlayController extends FrontendController
{
    public function index()
    {
        $resp = $this->apiGet('games/players');
        $players = $resp['data'] ?? $resp;
        $data = [];
        if (!empty($players) && isset($players[0]) && is_array($players[0])) {
            $data = array_map(function ($item, $index) {
                $item['id'] = $index + 1;
                return $item;
            }, $players, array_keys($players));
        }

        return view(
            'backoffice.games.game_setting',
            ['x' => $data]
        );
    }

    public function callList(Request $request)
    {
        try {
            $provider = $request->input('provider');
            $gamecode = $request->input('game_code');
            $username = $request->input('username');

            $act = $this->apiGet('games/call-list', [
                'provider' => $provider,
                'game_code' => $gamecode,
                'username' => $username,
            ]);

            return response()->json([
                'status' => 'success',
                'data'   => $act
            ]);

        } catch (\Exception $e) {
            Log::error('Error Call List: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'msg'    => 'Gagal mengambil data list call.'
            ], 500);
        }
    }

    public function callApply(Request $request)
    {
        $validated = $request->validate([
            'provider'       => 'required|string',
            'game_code'      => 'required|string',
            'username'       => 'required|string',
            'win_amount'     => 'required|numeric|min:0',
            'call_type'      => 'required|in:normal,buy',
            'bet_multiplier' => 'nullable|numeric|min:1',
        ]);

        try {
            $response = $this->apiPost('games/call-apply', $validated);

            Log::info('=== [CONTROLLER] Response dari Provider ===', [
                'provider_response' => $response
            ]);

            return response()->json([
                'status' => 'success',
                'msg'    => 'Call apply berhasil dikirim ke provider',
                'data'   => $response
            ]);

        } catch (\Exception $e) {
            Log::error('Error Call Apply Controller: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'msg'    => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getGameHistory(Request $request)
    {
        $date_start = $request->input('date_start', date('Y-m-d'));
        $date_end = $request->input('date_end', date('Y-m-d'));
        $extplayer = $request->input('extplayer', '');
        $gameType = $request->input('game_type', 'SLOT');

        \Illuminate\Support\Facades\Log::info('FE: getGameHistory called', [
            'url' => 'games/history',
            'params' => compact('date_start', 'date_end', 'extplayer', 'gameType')
        ]);

        $response = $this->apiGet('games/history', [
            'date_start' => $date_start,
            'date_end' => $date_end,
            'extplayer' => $extplayer,
            'game_type' => $gameType,
        ]);

        \Illuminate\Support\Facades\Log::info('FE: getGameHistory response', ['response' => $response]);

        return response()->json([
            'status' => 'success',
            'data' => $response['data'] ?? []
        ]);
    }

    public function showForm()
    {
        $resp = $this->apiGet('admin/users');
        $users = $resp['data']['users']['data'] ?? [];
        $users = json_decode(json_encode($users));
        return view('backoffice.historyplay.historyplay', compact('users'));
    }
}
