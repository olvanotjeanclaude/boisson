<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserValidityMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if (!$user->isSuperAdmin()) {
            $expire_at = $user->expiration_date;
            $now = now()->toDateTimeString();

            if ($expire_at && $expire_at < $now) {
                Auth::logout();
                return response()->view("errors.expired");
            }
        }

        return $next($request);
    }
}
