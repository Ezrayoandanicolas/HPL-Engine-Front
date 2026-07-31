<?php

namespace App\Http\Controllers;

use App\Services\WalletService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransferController extends FrontendController
{
    protected $wallet;

    public function __construct(WalletService $wallet)
    {
        parent::__construct();
        $this->wallet = $wallet;
    }

    public function index()
    {
        $data = $this->fetchPage('home');
        $user = Auth::user();
        $mainBalance = $this->wallet->getMainBalance($user);
        $slotBalance = $this->wallet->getSlotBalance($user);
        $gameBalance = $this->wallet->getGameBalance($user);
        return view('transfer', compact('mainBalance', 'slotBalance', 'gameBalance') + $data);
    }

    public function transfer(Request $request)
    {
        $request->validate([
            'from'   => 'required|in:main,slot,game',
            'to'     => 'required|in:main,slot,game',
            'amount' => 'required|numeric|min:1000',
        ]);

        if ($request->from == $request->to) {
            return back()->with('error', 'Asal dan tujuan transfer tidak boleh sama.');
        }

        $user = Auth::user();
        $amount = (float) $request->amount;

        $response = $this->apiPost('/wallet/transfer', [
            'user_id' => $user->id,
            'from'    => $request->from,
            'to'      => $request->to,
            'amount'  => $amount,
        ]);

        if (!empty($response['success'])) {
            $this->syncSessionUser($user, $response['balance'] ?? null);

            return back()->with('success', $response['message'] ?? 'Transfer berhasil.');
        }

        return back()->with('error', $response['message'] ?? 'Transfer gagal.');
    }

    private function syncSessionUser($user, ?array $balance = null): void
    {
        $sessionUser = session('api_user', []);
        $sessionUser['saldo'] = $balance['main'] ?? $user->saldo;
        $sessionUser['saldo_slot'] = $balance['slot'] ?? $user->saldo_slot;
        $sessionUser['saldo_game'] = $balance['game'] ?? $user->saldo_game;
        session(['api_user' => $sessionUser]);
    }
}
