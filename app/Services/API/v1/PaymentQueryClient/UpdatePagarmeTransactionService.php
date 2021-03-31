<?php


namespace App\Services\API\v1\PaymentQueryClient;


use App\Repositories\PagarmeTransactionRepository;

class UpdatePagarmeTransactionService
{
    private $pagarme_transaction_repository;

    public function __construct(
        PagarmeTransactionRepository $pagarme_transaction_repository)
    {
        $this->pagarme_transaction_repository = $pagarme_transaction_repository;
    }

    public function execute(int $query_id, $data)
    {
        $transaction = $this->pagarme_transaction_repository->findByQueryId($query_id)->first();

        if(!$transaction)
            throw new \Exception("A transação não foi localizada!", 500);

        return $this->pagarme_transaction_repository->edit($transaction, $data);
    }
}
