<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiManualTokenMiddleware
{
    public function __invoke(Request $request, Closure $next)
    {
        $manualToken = env('API_MANUAL_TOKEN');
        $authHeader = $request->header('Authorization');
        if (!$manualToken || !$authHeader || $authHeader !== 'Bearer ' . $manualToken) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        return $next($request);
    }
}
