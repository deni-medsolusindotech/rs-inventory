<?php
namespace App\Http\Middleware;

use Closure;

class DisableImageCaching
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        $response->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');

        return $response;
    }
}