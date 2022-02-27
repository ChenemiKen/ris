<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// import builder where defaultStringLength method is defined
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;
use Illuminate\Pagination\Paginator;
use NumberFormatter;

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
        // Fix for MySQL < 5.7.7 and MariaDB < 10.2.2
        Schema::defaultStringLength(191); //Update defaultStringLength
        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();

        Blade::directive('th', function ($expression) {
            return "<?php echo (new NumberFormatter('en_US', NumberFormatter::ORDINAL))->format({$expression}); ?>";
        });
    }
}
