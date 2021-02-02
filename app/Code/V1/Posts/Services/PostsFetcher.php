<?php

namespace App\Code\V1\Posts\Services;

use App\Code\V1\Posts\Repositories\PostRepository;
use App\Code\V1\Posts\Services\ExternalPosts\ExternalPostFetcherInterface;
use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

final class PostsFetcher
{
    private const POST_CACHE_KEY = 'post_cache_time';

    private ExternalPostFetcherInterface $externalPostFetcher;
    /**
     * @var PostRepository
     */
    private PostRepository $postRepository;

    public function __construct(
        ExternalPostFetcherInterface $externalPostFetcher,
        PostRepository $postRepository
    ) {
        $this->externalPostFetcher = $externalPostFetcher;
        $this->postRepository = $postRepository;
    }

    public function fetchPosts(?string $title): Collection
    {
        $this->cachePosts();
        return $this->postRepository->findPostsByTitle($title);
    }

    private function cachePosts()
    {
        $cacheTime = Cache::get(self::POST_CACHE_KEY);
        if (null === $cacheTime) {
            $this->externalPostFetcher->fetchPostsFromExternalSource();
            Cache::set(self::POST_CACHE_KEY, true, 60);
        }
    }
}