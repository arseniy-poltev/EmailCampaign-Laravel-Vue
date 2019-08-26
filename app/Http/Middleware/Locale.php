<?php

namespace App\Http\Middleware;

use Closure;
use App;

class Locale
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
        $locale = isset($_GET['locale']) ? $_GET['locale'] : null;
        if ($locale) {
            $request->session()->put('locale', $locale);
        } else {
            $locale = $request->session()->get('locale', 'en');
        }
        App::setLocale($locale);
        return $next($request);
    }
}