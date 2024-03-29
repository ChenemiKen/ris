<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     */
    public function register()
    {
    //Load all the files in the Helpers folder
        foreach (glob(app_path().'/Helpers/*.php') as $filename){
                require_once($filename);
        }
    }
}
