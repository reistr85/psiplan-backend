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
     * @return JsonResponse
     * @throws Exception
     */
    public function execute($user)
    {
        if(!$user)
            throw new Exception('Usuário não encontrado', 500);

        return response()->json(
            [
                'id' => encode($user->id),
                'name' => $user->name,
                'email' => $user->email,
            ]
        );
    }
}
