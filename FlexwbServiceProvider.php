<?php

namespace Modules\Flexwb;

use Illuminate\Support\ServiceProvider;

class FlexwbServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/views', 'fwb');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        //
    }
}
