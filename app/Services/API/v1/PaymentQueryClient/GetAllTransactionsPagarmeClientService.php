<?php


namespace App\Services\API\v1\PaymentQueryClient;


use App\Repositories\PagarmeTransactionRepository;

class GetAllTransactionsPagarmeClientService extends PagarmeTransactionRepository
{
    public function execute(int $client_id)
    {
        return parent::getAllByClientId($client_id)->get();
    }
}
