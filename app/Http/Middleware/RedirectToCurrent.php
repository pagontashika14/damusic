<?php

namespace App\Http\Middleware;

use Closure;

class RedirectToCurrent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        if(!$request->current_link) {
            $request->offsetSet('current_link', '/');
        }
        return $next($request);
    }
}
