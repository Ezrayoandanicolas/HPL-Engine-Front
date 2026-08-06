<?php

namespace App\Http\Controllers;

use App\Http\API\fiver;
use Illuminate\Http\Request;

class DashboardCallController extends BaseAdminController
{
    protected $fiver;

    public function __construct()
    {
        parent::__construct();
        $this->fiver = new fiver();
    }

    public function index()
    {
        $providers = $this->getProviders();

        $players = [];
        $resp = $this->api->get('games/players');
        if (isset($resp['success']) && $resp['success']) {
            $players = $resp['data'] ?? [];
        }

        $callHistory = [];
        $rawHistory = $this->fiver->callHistory(0, 50);
        $decodedHistory = json_decode($rawHistory, true);
        if ($decodedHistory && isset($decodedHistory['status']) && (int) $decodedHistory['status'] === 1) {
            $callHistory = $decodedHistory['data'] ?? [];
        }

        $users = $this->getUsers();

        return view('backoffice.call.index', compact('providers', 'players', 'callHistory', 'users'));
    }

    public function players()
    {
        $resp = $this->api->get('games/players');
        if (isset($resp['success']) && $resp['success']) {
            return response()->json(['status' => 'success', 'data' => ['data' => $resp['data'] ?? []]]);
        }
        return response()->json(['status' => 'error', 'msg' => 'Gagal mengambil data player.']);
    }

    public function callList(Request $request)
    {
        $request->validate([
            'provider'  => 'required',
            'game_code' => 'required',
        ]);

        $raw = $this->fiver->callList($request->provider, $request->game_code);
        $result = $this->parseResult($raw);
        return response()->json($result);
    }

    public function apply(Request $request)
    {
        $request->validate([
            'provider'       => 'required',
            'game_code'      => 'required',
            'username'       => 'required',
            'win_amount'     => 'required|numeric|min:1',
            'call_type'      => 'required|in:normal,buy',
        ]);

        $rawList = $this->fiver->callList($request->provider, $request->game_code);
        $decodedList = json_decode($rawList, true);
        $availableRtp = [];
        $hasBuyCall = false;
        if ($decodedList && isset($decodedList['status']) && (int) $decodedList['status'] === 1 && !empty($decodedList['calls'])) {
            foreach ($decodedList['calls'] as $c) {
                $availableRtp[] = (int) ($c['rtp'] ?? 0);
                if (stripos((string) ($c['call_type'] ?? ''), 'buy') !== false) {
                    $hasBuyCall = true;
                }
            }
        }

        $winAmount = (int) $request->win_amount;

        if (empty($availableRtp)) {
            return response()->json(['status' => 'error', 'msg' => 'Tidak ada call tersedia untuk game ini.']);
        }

        if (!in_array($winAmount, $availableRtp, true)) {
            return response()->json([
                'status' => 'error',
                'msg'    => 'Win Amount tidak valid. Pilih salah satu nilai dari Available Calls (' . min($availableRtp) . ' - ' . max($availableRtp) . ').',
            ]);
        }

        if ($request->call_type === 'buy' && !$hasBuyCall) {
            return response()->json([
                'status' => 'error',
                'msg'    => 'Game ini tidak memiliki fitur Buy Bonus. Gunakan call type Normal.',
            ]);
        }

        $raw = $this->fiver->callApply(
            $request->provider,
            $request->game_code,
            $request->username,
            $winAmount,
            $request->call_type
        );
        $result = $this->parseResult($raw);
        return response()->json($result);
    }

    public function cancel(Request $request)
    {
        $request->validate(['call_id' => 'required|numeric']);

        $raw = $this->fiver->callCancel($request->call_id);
        $result = $this->parseResult($raw);
        return response()->json($result);
    }

    public function history(Request $request)
    {
        $request->validate([
            'offset' => 'nullable|integer|min:0',
            'limit'  => 'nullable|integer|min:1|max:200',
        ]);

        $raw = $this->fiver->callHistory($request->offset ?? 0, $request->limit ?? 50);
        $result = $this->parseResult($raw);
        return response()->json($result);
    }

    public function controlRtp(Request $request)
    {
        $request->validate([
            'provider' => 'required',
            'username' => 'required',
            'rtp'      => 'required|numeric|min:0|max:999',
        ]);

        $raw = $this->fiver->controlUserRtp($request->provider, $request->username, $request->rtp);
        $result = $this->parseResult($raw);
        return response()->json($result);
    }

    public function controlUsersRtp(Request $request)
    {
        $request->validate([
            'usernames' => 'required|string',
            'rtp'       => 'required|numeric|min:0|max:999',
        ]);

        $usernames = array_map('trim', explode(',', $request->usernames));
        $usernames = array_filter($usernames);

        if (empty($usernames)) {
            return response()->json([
                'status' => 'error',
                'msg'    => 'Minimal 1 username.',
            ]);
        }

        $raw = $this->fiver->controlUsersRtp(array_values($usernames), $request->rtp);
        $result = $this->parseResult($raw);
        return response()->json($result);
    }

    public function gameLog(Request $request)
    {
        $params = [];
        if ($request->filled('date_start')) $params['date_start'] = $request->date_start;
        if ($request->filled('date_end'))   $params['date_end']   = $request->date_end;
        if ($request->filled('extplayer'))  $params['extplayer']  = $request->extplayer;
        if ($request->filled('game_type'))  $params['game_type']  = $request->game_type;

        $response = $this->api->get('games/history', $params);

        $data = $response['data'] ?? [];
        if (!is_array($data)) $data = [];

        return response()->json([
            'status' => 'success',
            'data'   => $data
        ]);
    }

    public function gameHistory(Request $request)
    {
        $resp = $this->api->post('games/in-game-history', [
            'user_code' => $request->user_code,
            'provider_code' => $request->provider_code,
            'game_code' => $request->game_code,
        ]);
        return response()->json($resp);
    }

    private function getUsers(): array
    {
        try {
            $resp = $this->api->get('admin/users');
            return $resp['data']['users']['data'] ?? [];
        } catch (\Exception $e) {
            return [];
        }
    }

    private function getProviders(): array
    {
        $resp = $this->api->get('games/providers');
        if (isset($resp['success']) && $resp['success'] && !empty($resp['data'])) {
            return $resp['data'];
        }

        try {
            $resp = $this->api->get('admin/exa-providers');
            $dbProviders = $resp['data'] ?? [];
            if (!empty($dbProviders)) {
                return array_map(function ($p) {
                    return ['provider_code' => $p['provider_code'] ?? '', 'provider_name' => $p['provider_name'] ?? ''];
                }, $dbProviders);
            }
        } catch (\Exception $e) {
        }

        return [
            ['provider_code' => 'PRAGMATIC', 'provider_name' => 'Pragmatic Play'],
            ['provider_code' => 'PGSOFT', 'provider_name' => 'PG Soft'],
            ['provider_code' => 'HABANERO', 'provider_name' => 'Habanero'],
            ['provider_code' => 'CQ9', 'provider_name' => 'CQ9'],
            ['provider_code' => 'JOKER', 'provider_name' => 'Joker Gaming'],
            ['provider_code' => 'PLAYSTAR', 'provider_name' => 'Playstar'],
            ['provider_code' => 'BOONGO', 'provider_name' => 'Booongo'],
            ['provider_code' => 'MICROGAMING', 'provider_name' => 'Microgaming'],
        ];
    }

    private function parseResult($raw): array
    {
        if (!$raw) {
            return ['status' => 'error', 'msg' => 'Gagal terhubung ke provider.'];
        }

        $decoded = json_decode($raw, true);
        if (!$decoded) {
            return ['status' => 'error', 'msg' => 'Respon provider tidak valid.'];
        }

        $success = isset($decoded['status']) && (int) $decoded['status'] === 1;

        return array_merge(
            $success ? ['status' => 'success'] : ['status' => 'error', 'msg' => $decoded['msg'] ?? 'Gagal'],
            ['data' => $decoded]
        );
    }
}
