<?php

namespace Christhompsontldr\Impersonate\Http\Middleware;

use Closure;

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
        if (auth()->guest() && session()->has('impersonate')) {
            session()->forget('impersonate');
        }

        //  start the impersonation
        if(!$request->is(str_replace('{user}', '*', config('impersonate.routes.start'))) && session()->has('impersonate')) {
            auth()->onceUsingId(session()->get('impersonate'));
        }

        $response = $next($request);

        /**
         *  Inject the configured blade into the view.
         */
        if(auth()->check() && session()->has('impersonate')) {
            $bar = view(config('impersonate.blade'));

            $content = $response->content();

            $content = preg_replace('!(<body[^>]*>)!', '$1' . $bar, $content, 1);

            $response->setContent($content);
        }

        return $response;
    }
}
