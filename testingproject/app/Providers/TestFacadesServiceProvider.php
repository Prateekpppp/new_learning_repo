<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App;

class TestFacadesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
        // App::bind('test',function() {
        //     return new \App\Test\TestFacades;
        //  });
        //  App::bind('test');
         App::bind('test','test');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
