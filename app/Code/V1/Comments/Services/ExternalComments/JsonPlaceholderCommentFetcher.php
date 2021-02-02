<?php

namespace App\Code\V1\Comments\Services\ExternalComments;

use App\Code\JSON\JsonPlaceholderEndpointService;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Http;

final class JsonPlaceholderCommentFetcher implements ExternalCommentFetcherInterface
{
    /**
     * @var JsonPlaceholderEndpointService
     */
    private JsonPlaceholderEndpointService $jsonApiService;

    public function __construct(JsonPlaceholderEndpointService $jsonApiService)
    {
        $this->jsonApiService = $jsonApiService;
    }

    public function fetchCommentsFromExternalSource(): void
    {
        $response = Http::get($this->jsonApiService->getCommentsUrl());

        foreach ($response->json() as $externalUser) {
            Comment::updateOrCreate(
                [
                    'id' =>  $externalUser['id'],
                ],
                [
                    'post_id' => $externalUser['postId'],
                    'name' => $externalUser['name'],
                    'body' => $externalUser['body'],
                    'email' => $externalUser['email'],
                ]
            );
        }
    }
}