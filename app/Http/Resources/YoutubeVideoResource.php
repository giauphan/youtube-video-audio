<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\YoutubeVideo
 */
class YoutubeVideoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'video_id' => $this->video_id,
            'title' => $this->title,
            'url_video' => $this->url_video,
            'thumbnail' => $this->thumbnail,
            'type' => $this->type,
            'history_video' =>$this->whenLoaded('')
        ];
    }
}
