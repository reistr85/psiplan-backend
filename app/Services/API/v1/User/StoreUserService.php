<?php


namespace App\Services\API\v1\User;


use App\Repositories\UserRepository;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StoreUserService extends UserRepository
{

    /**
     * Store new user
     *
     * @param int $user_type_id
     * @param array $user
     * @throws Exception
     */
    public function execute($user_type_id, $user)
    {
        $user = self::store($user);

        if(!$user)
            throw new Exception("Erro ao criar o usuário.", 500);
    }
}
