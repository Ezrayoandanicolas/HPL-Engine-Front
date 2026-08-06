<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect('/Admin/Login');
        }

        $role = auth()->user()->role;

        if (in_array($role, ['admin', 'promotor'])) {
            return $next($request);
        }

        if ($role === 'cashier') {
            if ($this->cashierAllowed($request->path())) {
                return $next($request);
            }
            return redirect('/cashier/dashboard');
        }

        return redirect('/Admin/Login');
    }

    /**
     * Paths a cashier is allowed to access.
     */
    protected function cashierAllowed(string $path): bool
    {
        $allowedPrefixes = [
            'Admin/Dashboard/Tranksaksi',
            'Admin/Dashboard/Withdraw',
            'Admin/Dashboard/User',
            'Admin/Dashboard/Livechat',
            'Admin/Dashboard/Voucher',
            'Admin/Dashboard/Fiver',
        ];

        foreach ($allowedPrefixes as $prefix) {
            if ($path === $prefix || str_starts_with($path, $prefix . '/')) {
                return true;
            }
        }

        $allowedExact = [
            'Admin/Dashboard',
            'dashboard',
            'cashier/dashboard',
            'Admin/Dashboard/GgrBalance',
            'Admin/Profile',
            'Admin/Logout',
            'deposits/today',
            'withdraw/today',
            'Admin/Dashboard/notifications/unread',
            'Admin/Dashboard/Deposit/Approve',
            'Admin/Dashboard/Withdraw/Approve',
            'admin-chat-sse',
            'admin-chat-sessions-sse',
        ];

        if (in_array($path, $allowedExact)) {
            return true;
        }

        foreach (['Admin/Dashboard/Deposit/Approve/', 'Admin/Dashboard/Withdraw/Approve/', 'admin-chat-sse/', 'admin-chat-sessions-sse/'] as $prefix) {
            if (str_starts_with($path, $prefix)) {
                return true;
            }
        }

        return false;
    }
}
