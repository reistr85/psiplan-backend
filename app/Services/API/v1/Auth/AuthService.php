<?php
namespace App\Services\API\v1\Auth;


use Illuminate\Http\Request;

class AuthService
{
    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }
}
