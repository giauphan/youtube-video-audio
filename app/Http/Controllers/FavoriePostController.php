<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class FavoriePostController extends Controller
{
    public function __invoke(Post $post, Request $request)
    {
        $post->favoriters()->create([
            'user_id' => $request->user()->getkey(),
        ]);

        return back()->with('success', 'Favories succes for post here');
    }
}
