<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TimeoutHandler
{
    /**
     * Handle an incoming request and set a longer timeout.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Set a longer timeout for PHP execution
        set_time_limit(120);
        
        // Continue with the request
        return $next($request);
    }
}
