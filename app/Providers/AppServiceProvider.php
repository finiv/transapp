<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Observers\{TransactionObserver,UserObserver};
use App\{Transaction, User}; 

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
        Transaction::observe(TransactionObserver::class);
        User::observe(UserObserver::class);
    }
}
