<?php


namespace App\Services\API\v1\Client;


use App\Models\Client;
use App\Repositories\ClientRepository;

class CreateClientBillingService extends ClientRepository
{
    public function execute(int $client_id, array $data)
    {
        $client = parent::find($client_id);
        $data['cpf'] = onlyNumber($data['cpf']);
        $data['cep'] = $data['zip_code'];

        $response = parent::edit($client, $data);

        if(!$response)
            throw new \Exception("Ocorreu um erro ao atualizar o dados.", 500);

        return $response;
    }
}
