<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Torann\GeoIP\Facades\GeoIP;

class RestrictNonItalianIP
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $location = GeoIP::getLocation($request->ip());

        if ($location && $location->country !== 'IT') {
            return response('Access denied', 403);
        }

        return $next($request);
    }
}
