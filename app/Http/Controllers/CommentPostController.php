<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentPostController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Post $post, CommentRequest $request)
    {
        $post->comments()->create([
            ...$request->validated(),
            'user_id' => $request->user()->getkey(),
        ]);

        return back()->with('success', 'Comment succes for post here');
    }
}
