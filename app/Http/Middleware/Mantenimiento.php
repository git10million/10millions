<?php

namespace App\Http\Middleware;

use Closure;

class Mantenimiento
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
        if(env('APP_MANTENIMIENTO')){
            if(session('rct')!=env('APP_PASSWORD_MANTENIMIENTO') && env('APP_ENV')!='dev'){
                return response(view('marketing.mantenimiento'));
            }
        }
        return $next($request);
    }
}
