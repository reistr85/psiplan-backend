<?php


namespace App\Services\API\v1\Psychologist;

use App\Repositories\PagarmeSubscriptionRepository;

class CreatePagarmeSubscriptionService
{

    private $pagarme_subscription_repository;

    public function __construct(
        PagarmeSubscriptionRepository $pagarme_subscription_repository)
    {
        $this->pagarme_subscription_repository = $pagarme_subscription_repository;
    }

    public function execute(array $data)
    {
        return $this->pagarme_subscription_repository->store($data);
    }
}
