<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsActive
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user() && !auth()->user()->is_active()) {
            return redirect('/verification');
        }
        return $next($request);
    }
}
