<?php

namespace App\Providers\API\v1;

use Illuminate\Support\ServiceProvider;

class PsychologistSpecialtyServiceProvider extends ServiceProvider
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
        \App\Models\PsychologistSpecialty::observe(\App\Observers\API\v1\PsychologistSpecialtyObserver::class);
    }
}
