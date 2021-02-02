<?php

namespace App\Code\V1\Comments\Controllers;

use App\Code\V1\Comments\Services\CommentsFetcher;
use Illuminate\Http\Request;

final class CommentController
{
    public function getComments(Request $request, CommentsFetcher $commentsFetcher)
    {
        $request->validate([
            'post_id' => 'required'
        ]);

        $comments = $commentsFetcher->fetchComments($request->post_id);

        return response()->json($comments);
    }
}