<?php


namespace App\Services\API\v1\PaymentPlanPsychologist;


use App\Repositories\PagarmeTransactionRepository;

class CreatePagarmeTransactionService extends PagarmeTransactionRepository
{
    public function execute(int $user_id, array $data_transaction)
    {

        $data = [
            'user_id' => $user_id,
            'transaction_id' => $data_transaction['transaction_id'],
            'status' => $data_transaction['status'],
            'amount' => $data_transaction['amount'],
        ];

        return parent::create($data_transaction);
    }
}
