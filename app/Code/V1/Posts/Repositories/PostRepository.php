<?php

namespace App\Code\V1\Posts\Repositories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;

final class PostRepository
{
    public function findPostsByTitle(?string $title): Collection
    {
        $posts = Post::select('*');

        if (null !== $title) {
            $posts = $posts->where('title', 'like', $title.'%');
        }

        return $posts->get();
    }
}