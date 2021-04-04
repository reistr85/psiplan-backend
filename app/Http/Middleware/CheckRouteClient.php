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
            return response()->json([
                'status' => false,
                'message' => 'Acesso não permitido, faça o seu login como cliente!'
            ], 401);

        return $next($request);
    }
}
