<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckIfUser
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
        $user = Auth::user();
        $roles = $user->role;
        //if admin
        foreach ($roles as $role) {
            if ($role->id == 1) {
                Auth::logout();
                return redirect('/');
            }
        }

        return $next($request);
    }
}