<?php

namespace App\Providers\Code\Users;

use App\Code\V1\Users\Services\ExternalUsers\ExternalUserFetcherInterface;
use App\Code\V1\Users\Services\ExternalUsers\JsonPlaceholderUserFetcher;
use Illuminate\Support\ServiceProvider;

class ExternalUserProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ExternalUserFetcherInterface::class, JsonPlaceholderUserFetcher::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
