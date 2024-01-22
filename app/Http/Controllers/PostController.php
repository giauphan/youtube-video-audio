<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostsResource;
use App\Models\CategoryBlog;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $validated = Validator::validate($request->all(), [
            'category_blog_name' => ['nullable', 'string'],
        ]);

        $categoryBlog = CategoryBlog::query()->get();

        $posts = Post::query()
            ->when(Arr::get($validated, 'category_blog_name'), function (Builder $query, string $category_sug) {
                $query->whereHas('CategoryBlog', fn (Builder $query) => $query->where('slug', $category_sug));
            })
            ->orderBy('view', 'desc')
            ->paginate(8)
            ->withQueryString();

        return view('Post.Index', [
            'categoryBlog' => $categoryBlog,
            'posts' => $posts,
        ]);
    }

    public function show(string $slug)
    {

        $post = Post::query()
            ->with('CategoryBlog')
            ->where('slug','like', $slug)
            ->published()
            ->firstOrFail();

        $cacheKey = sprintf('post:%s', $post->slug);

        if (! Cache::has($cacheKey)) {
            $post->increment('view');

            Cache::put($cacheKey, true, 10);
        }

        return view('Post.Show', [
            'posts' => new PostsResource($post),
        ]);
    }
}
