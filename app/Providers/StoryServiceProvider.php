<?php

namespace App\Providers;

use App\Services\StoryService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class StoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        App::bind('story', function() 
        {
            return new StoryService();
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
