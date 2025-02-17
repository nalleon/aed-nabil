<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class RolAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = JWTAuth::parseToken();
        JWTAuth::getPayload();
        $resp = JWTAuth::getPayload()->get('role');
        if ($resp == 'admin') {
        return $next($request);
        } else {
        return response()->json(['mensaje' => 'rol no autorizado'], 401);
        }
    }
}
