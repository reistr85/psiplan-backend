<?php


namespace App\Services\API\v1\Client;


use App\Repositories\ClientRepository;

class CreateClientService extends ClientRepository
{
    public function execute(array $data)
    {
        $client = parent::store($data);

        if(!$client)
            throw new \Exception("Erro ao criar o cliente.", 500);

        return $client;
    }
}
