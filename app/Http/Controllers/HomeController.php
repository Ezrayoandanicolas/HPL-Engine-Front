<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends FrontendController
{
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'cashier') {
                return redirect('/cashier/dashboard');
            }
            if (Auth::user()->role == 'admin') {
                return redirect('/Admin/Dashboard');
            }
        }
        $data = $this->fetchPage('home');
        if (!empty($data['setting']->maintenance)) {
            return view('errors.maintenance');
        }
        if (empty($data) || !isset($data['setting'])) {
            return response()->json(['error' => 'API data unavailable', 'data' => $data], 500);
        }
        return view('index', $data);
    }

    public function banner()
    {
        $data = $this->fetchPage('home');
        return response()->json($data);
    }

    public function claimDailyReward()
    {
        $response = $this->apiPost('home/claim-daily-reward');
        return response()->json($response);
    }

    public function resetReward()
    {
        $response = $this->apiPost('home/reset-reward');
        return response()->json($response);
    }

    public function updateReward()
    {
        return $this->resetReward();
    }

    public function getPlayerProgress()
    {
        $response = $this->apiGet('home/player-progress');
        return response()->json($response);
    }

    public function updateExpPlayer(Request $request)
    {
        $request->validate(['exp_player' => 'required|integer|min:100000']);
        $response = $this->apiPost('home/update-exp', $request->only('exp_player'));
        return response()->json($response);
    }

    public function getUserBadge()
    {
        $response = $this->apiGet('home/user-badge');
        return response()->json($response);
    }

    public function inject()
    {
        return response()->json(['msg' => 'API is currently bypassed']);
    }

    private function determineBadgeLevel($expPlayer)
    {
        if ($expPlayer >= 1000000) return 'diamond';
        if ($expPlayer >= 500000) return 'gold';
        if ($expPlayer >= 100000) return 'silver';
        return 'bronze';
    }
}
