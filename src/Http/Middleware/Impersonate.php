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
        //  check if requiring debug
        if (config('impersonate.require_debug') && !config('app.debug')) {
            session()->forget('impersonate');
        }

        //  no auth, no impersonate
        if (Auth::guest() && session()->has('impersonate')) {
            session()->forget('impersonate');
        }

        //  start the impersonation
        if(!$request->is(str_replace('{id}', '*', config('impersonate.routes.start'))) && session()->has('impersonate')) {
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