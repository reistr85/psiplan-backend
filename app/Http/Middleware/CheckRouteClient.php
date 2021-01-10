<?php

namespace App\Http\Middleware;

use Closure;

class CheckRouteClient
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
        $user = auth()->user();

        if($user->type_user_id != 3)
            return response()->json(['status' => 'Not Authorization Route'], 401);

        return $next($request);
    }
}
