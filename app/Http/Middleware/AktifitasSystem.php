<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AktifitasSystem
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
    	if (Auth::check()) {
    		if(Auth::getUser()->rules=='Administrator'){
	    		return $next($request);
    		}else{
    			return redirect('/');
    		}
    	}

    	return redirect('/login');
    }
}
