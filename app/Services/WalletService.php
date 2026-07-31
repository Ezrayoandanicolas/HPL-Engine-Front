<?php

namespace App\Services;

use App\Models\User;

class WalletService
{
    public function getMainBalance(User $user)
    {
        return (float) $user->saldo;
    }

    public function getSlotBalance(User $user)
    {
        return (float) $user->saldo_slot;
    }

    public function getGameBalance(User $user)
    {
        return (float) $user->saldo_game;
    }
}
