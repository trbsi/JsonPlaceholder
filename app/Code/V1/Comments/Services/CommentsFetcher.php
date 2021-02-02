<?php

namespace App\Code\V1\Comments\Services;

use App\Code\V1\Comments\Repositories\CommentRepository;
use App\Code\V1\Comments\Services\ExternalComments\ExternalCommentFetcherInterface;
use App\Code\V1\Posts\Repositories\PostRepository;
use App\Code\V1\Posts\Services\ExternalPosts\ExternalPostFetcherInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

final class CommentsFetcher
{
    private const COMMENT_CACHE_KEY = 'comment_cache_time';

    private ExternalCommentFetcherInterface $externalCommentFetcher;
    private CommentRepository $commentRepository;

    public function __construct(
        ExternalCommentFetcherInterface $externalPostFetcher,
        CommentRepository $commentRepository
    ) {
        $this->externalCommentFetcher = $externalPostFetcher;
        $this->commentRepository = $commentRepository;
    }

    public function fetchComments(int $id): Collection
    {
        $this->cachePosts();

        return $this->commentRepository->getCommentsByPostId($id);
    }

    private function cachePosts()
    {
        $cacheTime = Cache::get(self::COMMENT_CACHE_KEY);
        if (null === $cacheTime) {
            $this->externalCommentFetcher->fetchCommentsFromExternalSource();
            Cache::set(self::COMMENT_CACHE_KEY, true, 60);
        }
    }
}