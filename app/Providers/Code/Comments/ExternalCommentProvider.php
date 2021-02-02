<?php

namespace App\Providers\Code\Comments;

use App\Code\V1\Comments\Services\ExternalComments\ExternalCommentFetcherInterface;
use App\Code\V1\Comments\Services\ExternalComments\JsonPlaceholderCommentFetcher;
use App\Code\V1\Posts\Services\ExternalPosts\ExternalPostFetcherInterface;
use App\Code\V1\Posts\Services\ExternalPosts\JsonPlaceholderPostFetcher;
use App\Code\V1\Users\Services\ExternalUsers\ExternalUserFetcherInterface;
use App\Code\V1\Users\Services\ExternalUsers\JsonPlaceholderUserFetcher;
use Illuminate\Support\ServiceProvider;

class ExternalCommentProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ExternalCommentFetcherInterface::class, JsonPlaceholderCommentFetcher::class);
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
