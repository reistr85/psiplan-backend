<?php


namespace App\Services\API\v1\Auth;


class RespondWithTokenService
{
    /**
     * Get the token array structure.
     *
     * @param string $token
     * @return array
     */
    protected function respondWithTokenService($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 120
        ];
    }
}
