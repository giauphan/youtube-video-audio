<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\Post
 */
class PostsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'title' => $this->title,
            'summary' => $this->summary,
            'images' => $this->images,
            'published_at' => $this->published_at,
            'content' => $this->content,
            'view' => $this->view,
            'CategoryBlog' => CategoryBlog::make($this->whenLoaded('CategoryBlog')),
            'comments' => CommentResource::collection($this->whenLoaded('comments')),
        ];
    }
}
