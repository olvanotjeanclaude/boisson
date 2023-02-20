<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModeDevMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $modeDev = false;

        if($modeDev){
            $authorized = [
                "olvanotjcs@gmail.com"
            ];
    
            if (in_array(auth()->user()->email, $authorized)) {
                return $next($request);
            }
            
            return "Mbola manamboatra....";
        }
        
        return $next($request);
    }
}
