<?php


namespace App\Observers\API\v1;

use App\Models\PagarmeSubscriptionTransaction;

class PagarmeSubscriptionTransactionObserver
{
    public function creating(PagarmeSubscriptionTransaction $pagarmeSubscriptionTransaction)
    {
        $pagarmeSubscriptionTransaction->is_active = 1;
    }
}
