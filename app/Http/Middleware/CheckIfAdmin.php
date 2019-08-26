<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class CheckIfAdmin
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
                return $next($request);
            }
        }
        Auth::logout();
        return redirect('/');
    }
}