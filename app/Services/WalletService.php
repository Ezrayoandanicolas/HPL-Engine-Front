<?php

namespace App\Services;

use App\Models\User;
use App\Http\API\fiver;
use App\Http\API\Exa;

class WalletService
{
    protected $fiver;
    protected $exa;

    public function __construct()
    {
        $this->fiver = new fiver();
        $this->exa = new Exa();
    }

    /*
    |--------------------------------------------------------------------------
    | MAIN WALLET
    |--------------------------------------------------------------------------
    */

    public function getMainBalance(User $user)
    {
        return (float) $user->saldo;
    }

    /*
    |--------------------------------------------------------------------------
    | SLOT WALLET
    |--------------------------------------------------------------------------
    */

    public function getSlotBalance(User $user)
    {
        return (float) $user->saldo_slot;
    }

    public function getGameBalance(User $user)
    {
        return (float) $user->saldo_game;
    }

    public function transferToSlot(User $user, float $amount)
    {
        if ($user->saldo < $amount) {
            throw new \Exception('Saldo utama tidak mencukupi.');
        }

        $user->saldo -= $amount;
        $user->saldo_slot += $amount;
        $user->save();

        return true;
    }

    public function transferFromSlot(User $user, float $amount)
    {
        if ($user->saldo_slot < $amount) {
            throw new \Exception('Saldo Slot tidak mencukupi.');
        }

        $user->saldo_slot -= $amount;
        $user->saldo += $amount;
        $user->save();

        return true;
    }

    public function transferToGame(User $user, float $amount)
    {
        if ($user->saldo < $amount) {
            throw new \Exception('Saldo utama tidak mencukupi.');
        }

        $user->saldo -= $amount;
        $user->saldo_game += $amount;
        $user->save();

        return true;
    }

    public function transferFromGame(User $user, float $amount)
    {
        if ($user->saldo_game < $amount) {
            throw new \Exception('Saldo Game tidak mencukupi.');
        }

        $user->saldo_game -= $amount;
        $user->saldo += $amount;
        $user->save();

        return true;
    }
}