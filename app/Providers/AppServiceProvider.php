<?php

namespace App\Providers;

use View;
use App\Menu;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {   /****/
        $navMenus = Menu::where('status',1)->get();
        View::share([
            'navMenus' => $navMenus,
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
