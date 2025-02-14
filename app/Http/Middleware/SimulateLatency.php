<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SimulateLatency
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->query('latency') === null) {
            return $next($request);
        }

        // Optionally, you can add a delay to simulate latency
        $delay = min((int) $request->query('delay'), 5000); // Max 5 seconds

        usleep($delay * 1000); // Convert milliseconds to microseconds

        return $next($request);
    }
}
