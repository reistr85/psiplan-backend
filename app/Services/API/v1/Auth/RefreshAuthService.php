<?php
namespace App\Services\API\v1\Auth;


use Exception;

class RefreshAuthService extends RespondWithTokenService
{
    /**
     * Get a JWT via given credentials.
     *
     * @param $credentials
     * @return array
     * @throws Exception
     */
    public function execute($token)
    {
        if (!$token)
            throw new Exception('Token inválid.', 401);

        $retorno = self::respondWithTokenService($token);

        return $retorno['access_token'];
    }
}
