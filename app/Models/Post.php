<?php

namespace App\Models;

use Giauphan\CrawlBlog\Models\Post as ModelsPost;
use Illuminate\Database\Eloquent\Builder;
<<<<<<< Updated upstream
=======
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Laravel\Scout\Searchable;
>>>>>>> Stashed changes

class Post extends ModelsPost
{
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('published_at', '<=', now());
    }
<<<<<<< Updated upstream
=======

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

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
    
    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }
>>>>>>> Stashed changes
}
