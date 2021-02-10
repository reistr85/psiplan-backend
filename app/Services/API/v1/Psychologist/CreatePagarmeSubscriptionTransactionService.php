<?php


namespace App\Services\API\v1\Psychologist;


use App\Repositories\PagarmeSubscriptionTransactionRepository;

class CreatePagarmeSubscriptionTransactionService
{
    private $pagarme_subscription_transaction_repository;

    public function __construct(
        PagarmeSubscriptionTransactionRepository $pagarme_subscription_transaction_repository)
    {
        $this->pagarme_subscription_transaction_repository = $pagarme_subscription_transaction_repository;
    }

    public function execute(array $data)
    {
        return $this->pagarme_subscription_transaction_repository->store($data);
    }
}
