<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminCheck
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
        if(\Auth::user()->role == 'admin') {
            return $next($request);
        }
        \Auth::logout();
        \Session::flush();
        return redirect('admin/login')->with('warning', 'Unauthorised Access.');
    }
}
