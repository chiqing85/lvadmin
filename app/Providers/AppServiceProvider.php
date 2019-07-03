<?php

namespace App\Providers;

use App\logic\ConfigLogic;
use App\logic\RuleLogic;
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
        \View::composer('admin.layouts.aside', function ( $view ) {
             $aside = RuleLogic::aside();
             $view->with('aside', $aside);
        });

        \View::composer('admin.layouts.header', function ($view) {
            $in = \Auth::user()->notices->count();
            $view->with('CCS', $in);
        });


    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $cofig = ConfigLogic::getglob();
        $arr = [];
        foreach ($cofig as $k => $v )
        {
            $arr[ $v['k']] = $v['v'];
        }
        view()->share('cofig', $arr);
    }
}
