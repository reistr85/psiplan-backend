<?php

namespace App\Providers\API\v1;

use Illuminate\Support\ServiceProvider;

class PsychologistServiceProvider extends ServiceProvider
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
        \App\Models\Psychologist::observe(\App\Observers\API\v1\PsychologistObserver::class);
    }
}
