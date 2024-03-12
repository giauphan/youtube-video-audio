<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class YoutubeVideo extends Model
{
    protected $guarded = [];

    public function historyVideo(): HasMany
    {
        return $this->hasMany(HistoryVideo::class);
    }
}
