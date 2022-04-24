<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        if (Auth::guest()) {
            return redirect('/login');
        }

        if (!$request->user()->hasPermissionTo($permission)) {
            return redirect('/home');
        }

        return $next($request);
    }
}
