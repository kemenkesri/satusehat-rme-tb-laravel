<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Models\Users;

class UserActivity
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
        if (Auth::check()) {
            // $expiresAt = now()->addMinutes(1); /* keep online for 2 min */
            // Cache::put('user-is-online-' . Auth::user()->id, true, $expiresAt);

            Users::where('id', Auth::user()->id)
            ->update(['last_seen' => now()])
            ;   
        }

        return $next($request);
    }
}
