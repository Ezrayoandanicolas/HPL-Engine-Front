<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SetApiUser
{
    public function handle(Request $request, Closure $next): Response
    {
        $userData = session('api_user');

        if ($userData && isset($userData['id'])) {
            $user = new User();
            $user->forceFill($userData);
            Auth::setUser($user);
        }

        return $next($request);
    }
}
