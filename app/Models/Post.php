<?php

namespace App\Models;

use Giauphan\CrawlBlog\Models\Post as ModelsPost;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Scout\Searchable;

class Post extends ModelsPost
{
    use Searchable;

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('published_at', '<=', now());
    }

    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'summary' => $this->summary,
            'tags' => $this->tags,
            'published_at' => $this->published_at,
        ];
    }
}
