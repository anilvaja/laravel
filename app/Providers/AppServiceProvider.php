<?php

namespace App\Providers;

use App\Navigation;
use View;
use Illuminate\Support\Facades\Schema;
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

        Schema::defaultStringLength(191);
        View::composer('*', function($view)
        {
            $menu_item= Navigation::all();
            $view->with('menu_item', $menu_item);


        });
    }
}
