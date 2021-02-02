<?php

namespace App\Code\V1\Posts\Services\ExternalPosts;

interface ExternalPostFetcherInterface
{
    public function fetchPostsFromExternalSource(): void;
}