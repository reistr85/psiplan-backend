<?php


namespace App\Observers\API\v1;


use App\Models\PagarmeSubscription;

class PagarmeSubscriptionObserver
{
    public function creating(PagarmeSubscription $pagarmeSubscription)
    {
        $pagarmeSubscription->is_active = 1;
    }
}
