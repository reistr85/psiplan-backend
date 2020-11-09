<?php
namespace App\Services\API\v1\Auth;


use Exception;

class CreateAuthService extends RespondWithTokenService
{
    /**
     * Get a JWT via given credentials.
     *
     * @param $credentials
     * @return array
     * @throws Exception
     */
    public function execute($credentials)
    {
        if(empty($credentials['email']) || empty($credentials['password']))
            throw new Exception('Digite o e-mail e/ou senha.', 500);

        if (!$token = auth()->attempt($credentials))
            throw new Exception('E-mail e/ou senha inválido(s).', 401);

        return self::respondWithTokenService($token);
    }
}
