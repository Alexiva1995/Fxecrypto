<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Guard;

class Https{
    public function handle($request, Closure $next, $guard = null)
    {
        if (!$request->secure() && env('APP_ENV') === 'prod') {
        	return redirect()->secure($request->getRequestUri());
        }

        return $next($request);
    }
}
