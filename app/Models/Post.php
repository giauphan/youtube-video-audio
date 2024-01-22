<?php

namespace App\Models;

use Giauphan\CrawlBlog\Models\Post as ModelsPost;
use Illuminate\Database\Eloquent\Builder;

class Post extends ModelsPost
{
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('published_at', '<=', now());
    }
}
