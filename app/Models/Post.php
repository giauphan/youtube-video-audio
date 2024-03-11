<?php

namespace App\Models;

use Giauphan\CrawlBlog\Models\Post as ModelsPost;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Post extends ModelsPost
{
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('published_at', '<=', now());
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
    
    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }
}
