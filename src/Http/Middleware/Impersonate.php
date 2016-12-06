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
        if(session()->has('impersonate'))
        {
            Auth::onceUsingId(session()->get('impersonate'));
        }

        return $next($request);
    }
}