<?php

namespace App\Providers;

use App\Services\PhotoService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class PhotoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        App::bind('photo', function() 
        {
            return new PhotoService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
