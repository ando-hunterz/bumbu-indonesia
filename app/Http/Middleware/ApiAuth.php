<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiAuth
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
        if (!$request->hasHeader('X-visitor-id')) {
            return response()->json([
                'status' => '2',
                'message' => 'No visitor id found'
            ], 400);
        }
        return $next($request);
    }
}
