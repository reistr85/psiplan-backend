<?php


namespace App\Services\API\v1\Client;


use App\Repositories\ClientRepository;
use Exception;
use Illuminate\Database\Eloquent\Model;

class GetClientByUserIdService extends ClientRepository
{

    /**
     * Execute
     *
     * @param int $user_id
     * @return Model
     * @throws Exception
     */
    public function execute(int $user_id): Model
    {
        $client = parent::findByUserId($user_id);

        if(!$client)
            throw new Exception('O cliente não localizado', 400);

        return $client;
    }
}
