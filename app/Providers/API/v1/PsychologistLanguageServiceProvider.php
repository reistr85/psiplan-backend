<?php

namespace App\Providers\API\v1;

use Illuminate\Support\ServiceProvider;

class PsychologistLanguageServiceProvider extends ServiceProvider
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
        \App\Models\PsychologistLanguage::observe(\App\Observers\API\v1\PsychologistLanguageObserver::class);
    }
}
