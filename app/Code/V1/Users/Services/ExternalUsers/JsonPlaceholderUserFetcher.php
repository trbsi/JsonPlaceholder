<?php

namespace App\Code\V1\Users\Services\ExternalUsers;

use App\Code\JSON\JsonPlaceholderEndpointService;
use App\Code\V1\Users\Services\ExternalUsers\ExternalUserFetcherInterface;
use App\Code\V1\Users\Services\UsersFetcher;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

final class JsonPlaceholderUserFetcher implements ExternalUserFetcherInterface
{
    /**
     * @var JsonPlaceholderEndpointService
     */
    private JsonPlaceholderEndpointService $jsonApiService;

    public function __construct(JsonPlaceholderEndpointService $jsonApiService)
    {
        $this->jsonApiService = $jsonApiService;
    }

    public function fetchUsersFromExternalSource(): void
    {
        $response = Http::get($this->jsonApiService->getUsersUrl());

        foreach ($response->json() as $externalUser) {
            User::updateOrCreate(
                [
                    'id' =>  $externalUser['id'],
                ],
                [
                    'name' => $externalUser['name'],
                    'username' => $externalUser['username'],
                    'email' => $externalUser['email'],
                ]
            );
        }
    }
}