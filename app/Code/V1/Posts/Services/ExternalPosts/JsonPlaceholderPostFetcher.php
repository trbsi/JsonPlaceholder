<?php

namespace App\Code\V1\Posts\Services\ExternalPosts;

use App\Code\JSON\JsonPlaceholderEndpointService;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Http;

final class JsonPlaceholderPostFetcher implements ExternalPostFetcherInterface
{
    /**
     * @var JsonPlaceholderEndpointService
     */
    private JsonPlaceholderEndpointService $jsonApiService;

    public function __construct(JsonPlaceholderEndpointService $jsonApiService)
    {
        $this->jsonApiService = $jsonApiService;
    }

    public function fetchPostsFromExternalSource(): void
    {
        $response = Http::get($this->jsonApiService->getPostsUrl());

        foreach ($response->json() as $externalPost) {
            Post::updateOrCreate(
                [
                    'id' =>  $externalPost['id'],
                ],
                [
                    'user_id' => $externalPost['userId'],
                    'title' => $externalPost['title'],
                    'body' => $externalPost['body'],
                ]
            );
        }
    }
}