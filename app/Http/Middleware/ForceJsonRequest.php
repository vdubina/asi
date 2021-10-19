<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;

/**
 * Forces Json Request for API Call
 */
class ForceJsonRequest extends Middleware
{
    /**
     * Sets the Accept header to application/json for API routes
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        if ($request->is('api/*')) {
            $request->headers->set('Accept', 'application/json');
        }
        return $next($request);
    }
}
