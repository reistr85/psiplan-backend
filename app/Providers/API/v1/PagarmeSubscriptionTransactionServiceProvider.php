<?php

namespace App\Providers\API\v1;

use Illuminate\Support\ServiceProvider;

class PagarmeSubscriptionTransactionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        \App\Models\PagarmeSubscriptionTransaction::observe(\App\Observers\API\v1\PagarmeSubscriptionTransactionObserver::class);
    }
}
