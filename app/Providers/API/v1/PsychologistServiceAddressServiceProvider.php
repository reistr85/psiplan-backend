<?php

namespace App\Providers\API\v1;

use Illuminate\Support\ServiceProvider;

class PsychologistServiceAddressServiceProvider extends ServiceProvider
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
        \App\Models\PsychologistServiceAddress::observe(\App\Observers\API\v1\PsychologistServiceAddressObserver::class);
    }
}
