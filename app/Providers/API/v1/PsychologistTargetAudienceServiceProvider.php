<?php

namespace App\Providers\API\v1;

use Illuminate\Support\ServiceProvider;

class PsychologistTargetAudienceServiceProvider extends ServiceProvider
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
        \App\Models\PsychologistTargetAudience::observe(\App\Observers\API\v1\PsychologistTargetAudienceObserver::class);
    }
}
