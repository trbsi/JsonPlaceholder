<?php

namespace App\Code\JSON;

final class JsonPlaceholderEndpointService
{
    /**
     * @var string
     */
    private string $baseUrl;

    public function __construct(string $baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    public function getUsersUrl(): string
    {
        return sprintf('%s/users', $this->baseUrl);
    }

    public function getPostsUrl(): string
    {
        return sprintf('%s/posts', $this->baseUrl);
    }

    public function getCommentsUrl(): string
    {
        return sprintf('%s/comments', $this->baseUrl);
    }
}