<?php

namespace App\Providers\Code\Posts;

use App\Code\V1\Posts\Services\ExternalPosts\ExternalPostFetcherInterface;
use App\Code\V1\Posts\Services\ExternalPosts\JsonPlaceholderPostFetcher;
use App\Code\V1\Users\Services\ExternalUsers\ExternalUserFetcherInterface;
use App\Code\V1\Users\Services\ExternalUsers\JsonPlaceholderUserFetcher;
use Illuminate\Support\ServiceProvider;

class ExternalPostProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ExternalPostFetcherInterface::class, JsonPlaceholderPostFetcher::class);
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
