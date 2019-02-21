<?php

namespace App\Providers;

use View;
use App\Menu;
use App\Tag;
use App\Logo;
use App\Share;
use App\Follow;
use App\Storefront;
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
        $mainMenus   = Menu::where([['status',1],['setting','<>',1]])->get();
        $mainTag     = Tag::where([['setting',10],['status',1]])->first();
        $mainStore   = Storefront::where([['setting',10],['status',1]])->first();
        $mainLogo    = Logo::where('setting','main')->first();
        $mainFollows = Follow::all();
        $mainShares  = Share::all();
        View::share([
            'mainMenus'   => $mainMenus,
            'mainTag'     => $mainTag,
            'mainStore'   => $mainStore,
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
