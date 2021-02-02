<?php

namespace App\Code\V1\Posts\Controllers;

use App\Code\V1\Posts\Services\PostsFetcher;
use Illuminate\Http\Request;

final class PostController
{
    public function getPosts(Request $request, PostsFetcher $postsFetcher)
    {
        $posts = $postsFetcher->fetchPosts($request->title);

        return response()->json($posts);
    }
}