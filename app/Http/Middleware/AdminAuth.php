<?php

namespace App\Http\Middleware;

use Closure;

class AdminAuth
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
        // check if admin is authenticated
        if (!\Auth::guard('admin')->check()) {
            return redirect()->route('admin-logout');
        }
        return $next($request);
    }
}
