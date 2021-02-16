<?php


namespace App\Services\API\v1\PaymentQueryClient;


use App\Repositories\PagarmeTransactionRepository;

class CreatePagarmeTransactionService extends PagarmeTransactionRepository
{
    public function execute(int $user_id, array $data_transaction)
    {
        return parent::create($data_transaction);
    }
}
