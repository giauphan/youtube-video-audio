<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\VideoSaveRequest;
use Illuminate\Support\Facades\Cache;

class VideoSaveController extends Controller
{
    public function __invoke(VideoSaveRequest $request)
    {
        $savevideo = $request->validated();

        $getvideo = Cache::get('video_user') ?? [];

        $data = [
            'video_id' => $savevideo['video_id'],
            'user_id' => $request->user()->id,
            'title' => $savevideo['title'] ?? null,
            'url_video' => $savevideo['url_video'] ?? null,
            'thumbnail' => $savevideo['thumbnail'] ?? null,
            'type' => $savevideo['type'] ?? 'video',
        ];

        $getvideo[$savevideo['video_id']] = $data;

        Cache::put('video_user', $getvideo, 7200);

        return redirect()->route('video.index', ['video' => $savevideo['video_id'], 'type_video' => $savevideo['type'] ?? 'video'])->with('success', 'Save in list success');
    }
}
