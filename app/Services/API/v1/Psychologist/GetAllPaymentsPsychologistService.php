<?php


namespace App\Services\API\v1\Psychologist;


use App\Repositories\PagarmeSubscriptionTransactionRepository;

class GetAllPaymentsPsychologistService
{
    private $pagarme_subscription_transaction_repository;

    public function __construct(
        PagarmeSubscriptionTransactionRepository $pagarme_subscription_transaction_repository)
    {
        $this->pagarme_subscription_transaction_repository = $pagarme_subscription_transaction_repository;
    }

    public function execute(int $user_id)
    {
        $transactions = $this->pagarme_subscription_transaction_repository->getAllSubscriptionTransactionsByUserId($user_id);

        return $transactions->get();
    }
}
