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

        if($request->header('ApiKey') != 'base64:MSIE1FPQzRRDEN3jEfgpPD8z+X8HE0neFHI2kgnowXY=')
            return response()->json(['error' => 'ApiKey invalid'], 401);

        return $next($request);
    }
}
