<?php


namespace App\Observers\API\v1;


use App\Models\PagarmeTransaction;

class PagarmeTransactionObserver
{
    public function creating(PagarmeTransaction $pagarmeTransaction)
    {
        $pagarmeTransaction->is_active = 1;
    }
}
