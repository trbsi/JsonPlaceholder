<?php

namespace App\Code\V1\Comments\Repositories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Collection;

final class CommentRepository
{
    public function getCommentsByPostId(int $id): Collection
    {
        return Comment::where('post_id', $id)->get();
    }
}