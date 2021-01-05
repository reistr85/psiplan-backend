<?php

namespace App\Providers\API\v1;

use Illuminate\Support\ServiceProvider;

class PagarmeSubscriptionServiceProvider extends ServiceProvider
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
        \App\Models\PagarmeSubscription::observe(\App\Observers\API\v1\PagarmeSubscriptionObserver::class);
    }
}
