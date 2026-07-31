<?php

namespace App\Http\Middleware;

use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    protected function authenticate($request, array $guards)
    {
        // Check session directly in case SetApiUser middleware didn't run
        $userData = session('api_user');
        if ($userData && isset($userData['id'])) {
            $user = new User();
            $user->forceFill($userData);
            Auth::setUser($user);
            return;
        }

        parent::authenticate($request, $guards);
    }

    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }
}
