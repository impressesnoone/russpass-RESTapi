<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!auth('sanctum')->user()){
            return response()->json([
                'data' => [
                    'status' => false,
                    'code' => 401,
                    'message' => 'Unauthorized'
                ]
            ], 401);
        }
        if(auth('sanctum')->user()->role !== 'admin'){
            return response()->json([
                'data' => [
                    'status' => false,
                    'code' => 401,
                    'message' => 'Access Denied'
                ]
            ], 401);
        }
        return $next($request);
    }
}
