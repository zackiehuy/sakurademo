<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Session::has('language')) {
            App::setLocale(Session::get('language'));
        } else {
            App::setLocale('en');
        }
        config(['app.locale' => Session::get('language')]);
        return $next($request);
    }
}
