<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;

class AdminMiddleware
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
        $admin = JWTAuth::user()->admin;
        if($admin === 1 ){

            return $next($request);
        }
        return response()->json([
            'message' => 'Error - Forbidden',
            'error' => 'The user not have permission for the request.'
        ])->setStatusCode(403) ;

    }
}
