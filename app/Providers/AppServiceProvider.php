<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Observers\TweetObserver;
use App\Observers\UserObserver;

use App\Models\Tweet;
use App\Models\User;



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
        Tweet::observe(TweetObserver::class);

        User::observe(UserObserver::class);
    }
}
