<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserCheck
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
        if(\Auth::user()->role == 'user') {
            return $next($request);
        }
        \Auth::logout();
        \Session::flush();
        return redirect('user/login')->with('warning', 'Unauthorised Access.');
    }
}
