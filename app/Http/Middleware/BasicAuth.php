<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;

/**
 * Basic Authentication
 */
class BasicAuth extends Middleware
{
    /**
     * Protects route with basic auth
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        header('Cache-Control: no-cache, must-revalidate, max-age=0');
        $credentials = !(empty($_SERVER['PHP_AUTH_USER']) && empty($_SERVER['PHP_AUTH_PW']));
        $denied = (
            !$credentials ||
            $_SERVER['PHP_AUTH_USER'] != env('BASIC_AUTH_USER') ||
            $_SERVER['PHP_AUTH_PW']   != env('BASIC_AUTH_PASSWORD')
        );
        if ($denied) {
            header('HTTP/1.1 401 Authorization Required');
            header('WWW-Authenticate: Basic realm="Access denied"');
            exit;
        }
        return $next($request);
    }
}
