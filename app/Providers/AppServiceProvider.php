<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Registration;
use App\Observers\RegistrationObserver;


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
    public function boot(): void
    {
    Registration::observe(RegistrationObserver::class);
    }
}
