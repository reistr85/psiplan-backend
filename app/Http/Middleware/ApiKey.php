<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(empty($request->header('ApiKey')))
            return response()->json(['error' => 'ApiKey not found'], 401);

        if($request->header('ApiKey') != env('APP_KEY'))
            return response()->json(['error' => 'ApiKey invalid'], 401);

        return $next($request);
    }
}
