<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class ShareUserBalance
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();

            View::share('mainBalance', (float) ($user->saldo ?? 0));
            View::share('slotBalance', (float) ($user->saldo_slot ?? 0));
            View::share('gameBalance', (float) ($user->saldo_game ?? 0));
            View::share('balance', (float) ($user->saldo ?? 0));
        }

        return $next($request);
    }
}
