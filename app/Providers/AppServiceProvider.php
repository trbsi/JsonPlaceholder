<?php

namespace App\Providers;

use App\Code\JSON\JsonPlaceholderEndpointService;
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
        $this->app->bind(JsonPlaceholderEndpointService::class, function ($app) {
            return new JsonPlaceholderEndpointService(env('BASE_JSON_URL'));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
