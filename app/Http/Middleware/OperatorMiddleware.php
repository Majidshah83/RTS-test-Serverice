<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class OperatorMiddleware
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
        if (Auth::user()->role != "Admin" && Auth::user()->role != "Superadmin"  && Auth::user()->role != "Operator"){
            return redirect('/current/projects');
        }
        return $next($request);
    }
}
