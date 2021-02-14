<?php


namespace App\Services\API\v1\PaymentPlanPsychologist;


use App\Repositories\PagarmeSubscriptionRepository;

class GetPagarmeSubscriptionByIdService
{

    private $pagarme_subscription_repository;

    public function __construct(
        PagarmeSubscriptionRepository $pagarme_subscription_repository)
    {
        $this->pagarme_subscription_repository = $pagarme_subscription_repository;
    }

    public function execute()
    {
        $user = auth()->user();
        $pagarme_subscription = $this->pagarme_subscription_repository->findByUserId($user->id);

        if(!$pagarme_subscription)
            throw new \Exception("A assinatura não foi localizada", 500);


        return $pagarme_subscription;
    }
}
