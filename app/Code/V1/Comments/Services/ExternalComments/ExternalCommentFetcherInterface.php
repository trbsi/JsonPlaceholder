<?php

namespace App\Code\V1\Comments\Services\ExternalComments;

interface ExternalCommentFetcherInterface
{
    public function fetchCommentsFromExternalSource(): void;
}