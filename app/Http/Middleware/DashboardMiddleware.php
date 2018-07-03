<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class DashboardMiddleware
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
        $user=Auth::user();
        if ($user->hasRole('SuperAdmin')||$user->hasRole('admin'))
        {
            return $next($request);
        }
        else
        {
            return redirect()->route('index');
        }
    }
}
