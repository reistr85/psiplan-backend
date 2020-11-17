<?php


namespace App\Services\API\v1\Auth;


use Exception;
use Illuminate\Http\JsonResponse;

class MeService
{
    /**
     * Get the authenticated User.
     *
     * @param $user
     * @return array
     * @throws Exception
     */
    public function execute($user)
    {
        if(!$user)
            throw new Exception('Usuário não encontrado', 500);

        return [
            'id' => encode($user->id),
            'name' => $user->name,
            'email' => $user->email,
        ];
    }
}
