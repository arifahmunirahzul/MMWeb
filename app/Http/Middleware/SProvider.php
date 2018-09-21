<?php

namespace App\Http\Middleware;

use Closure;

class SProvider
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
        if (Auth::check() && Auth::user()->role == 'ServiceProvider') {
            return $next($request);
        }

        else {
            return redirect('error');
        }
    }
}
