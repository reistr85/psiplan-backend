<?php

namespace App\Providers\API\v1;

use Illuminate\Support\ServiceProvider;

class EvaluationServiceProvider extends ServiceProvider
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
        \App\Models\Evaluation::observe(\App\Observers\API\v1\EvaluationObserver::class);
    }
}
