<?php

namespace Linxy49\LaraZaif;

use Illuminate\Support\ServiceProvider as BasicServiceProvider;

class ServiceProvider extends BasicServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('larazaif',function(){
            return new Client;
        });
    }
}
