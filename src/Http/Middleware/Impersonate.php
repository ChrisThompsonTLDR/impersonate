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

        $response = $next($request);

        if(session()->has('impersonate')) {
            $bar = view('impersonate::stop');

            $content = $response->content();

            $content = preg_replace('!(<body[^>]*>)!', '$1' . $bar, $content, 1);

            $response->setContent($content);
        }

        return $response;
    }
}
