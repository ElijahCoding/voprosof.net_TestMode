<?php

namespace App\Providers;

use Cache;
use View;
use App\Channel;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // View::share('channels', Channel::all());
        View::composer(['threads.create', 'layouts.app'], function($view) {
          $channels = Cache::rememberForever('channels', function() {
            return Channel::all();
          });

          $view->with('channels', $channels);
        });
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
