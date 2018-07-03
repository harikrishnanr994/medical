<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class ApiCheck
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
        $request->headers->set('Authorization', preg_replace('/^\w+\s+/','', trim($request->header('Authorization'))));

        if(!count(User::where(['api_token' => $request->header('Authorization'), 'is_deleted' => 0])->get())|| empty($request->header('Authorization')))
        {
            return response()->json(['code'=>401,'message'=>'Please Login'],401);
        }
        return $next($request);
    }
}
