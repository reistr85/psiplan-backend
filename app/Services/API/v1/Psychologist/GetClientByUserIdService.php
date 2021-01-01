<?php


namespace App\Services\API\v1\Psychologist;


use App\Repositories\ClientRepository;

class GetClientByUserIdService extends ClientRepository
{
    public function execute(int $user_id)
    {
        $client = parent::findByUserId($user_id);

        return $client;
    }
}
