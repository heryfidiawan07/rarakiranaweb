<?php

namespace App\Providers;

use View;
use App\Menu;
use App\Logo;
use App\Share;
use App\Follower;
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
        $navMenus    = Menu::where('status',1)->get();
        $mainLogo    = Logo::where('setting',1)->first();
        $mainFollows = Follower::all();
        $mainShares  = Share::all();
        View::share([
            'navMenus'    => $navMenus,
            'mainLogo'    => $mainLogo,
            'mainFollows' => $mainFollows,
            'mainShares'  => $mainShares,
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
