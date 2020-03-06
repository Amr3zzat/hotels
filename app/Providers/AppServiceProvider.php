<?php

namespace App\Providers;

use App\Services\HotelsProviderB;
use App\Http\Controllers\Api\HotelsController;
use Illuminate\Support\ServiceProvider;
use App\Services\HotelsProviderA;

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
        $this->app->bind('hotelsProviders', function ($app) {
            return [
                $this->app->make(HotelsProviderA::class),
                $this->app->make(HotelsProviderB::class),
            ];
        });

        $this->app->bind(HotelsController::class, function () {
            return new HotelsController($this->app->make('hotelsProviders'));
        });
    }
}
