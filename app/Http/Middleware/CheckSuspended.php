<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSuspended
{
    public function handle($request, \Closure $next)
    {
        if (auth()->check() && auth()->user()->is_suspended) {
            auth()->logout();
            return redirect('/login')->withErrors([
                'email' => 'Your account has been suspended.'
            ]);
        }

        return $next($request);
    }
}   
