<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {   
        $user = $request->user();
        
        $check = $user->hasRole($role,$user->id);

        if (count($check) > 0) {
            return $next($request);
        }

        return redirect('dashboard');
    }
}
