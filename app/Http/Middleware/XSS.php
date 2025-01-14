<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class XSS
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

        $input = $request->all();
        if ($request->is_surat == 'true') {
            return $next($request);
        }
        array_walk_recursive($input, function(&$input) {
            if ($input) {
                $input = strip_tags($input);
            }
        });        
        
        $request->merge($input);
        return $next($request);
    }     
}
