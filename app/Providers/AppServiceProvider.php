<?php

namespace App\Providers;

use App\Honeypot\Honeypot;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Honeypot::abortUsing(function(){
            return response('Handle it however you want.');
        });
    }
}
