<?php

namespace App\Models;

use Giauphan\CrawlBlog\Models\Post as ModelsPost;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Overtrue\LaravelFavorite\Traits\Favoriteable;

class Post extends ModelsPost
{
    use Favoriteable;

    protected $dates = [
        'published_at'=>'datetime',
        'view' => 'int',
    ];
    

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('published_at', '<=', now());
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function favorites(): MorphMany
    {
        return $this->morphMany(Favorite::class, 'favoriteable');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
