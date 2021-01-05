<?php

namespace App\Providers\API\v1;

use Illuminate\Support\ServiceProvider;

class PagarmeTransactionServiceProvider extends ServiceProvider
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
        \App\Models\PagarmeTransaction::observe(\App\Observers\API\v1\PagarmeTransactionObserver::class);
    }
}
