<?php

namespace Christhompsontldr\Impersonate\Http\Middleware;

use Closure;
use Auth;

class Impersonate
{
    /**
     * Handle an incoming request.
     */
    public function handle($request, Closure $next)
    {
        if (config('impersonate.require_debug') && !config('app.debug')) {
            session()->forget('impersonate');
        }

        if(session()->has('impersonate')) {
            Auth::onceUsingId(session()->get('impersonate'));
        }

        return $next($request);
    }

    public function terminate($request, $response)
    {
        if(session()->has('impersonate')) {
            echo view('impersonate::stop');
        }
    }
}