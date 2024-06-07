<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class headerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next): Response
    // {
    //     return $next($request)
    //     ->header('Access-Control-Allow-Origin', '*')
    //     ->header('Access-Control-Allow-Methods', '*')
    //     ->header('Access-Control-Allow-Credentials', true)
    //     ->header('Access-Control-Allow-Headers', 'X-Requested-With,Content-Type,X-Token-Auth,Authorization')
    //     ->header('Accept', 'application/json');
    // }


    public function handle($request, Closure $next)
    {
        //set headers
        $response = $next($request);
        $response->headers->set('X-Custom-Header', 'Jitendra');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', '0');
        $response->headers->set('Cache-Control', 'no-cache,no-store');
        // // $response->headers->set('Content-Security-Policy', "default-src 'self'");

        $response->headers->set('Access-Control-Allow-Origin', "*");

        $response->headers->set('Strict-Transport-Security', "max-age=31536000; includeSubDomains; preload");

        // //set REFERER
        // if (isset($_SERVER["HTTP_REFERER"]) && !$_SERVER["HTTP_REFERER"]) {
        //     abort(401, 'Unauthorized.');
        // }

        return $response;
    }
}
