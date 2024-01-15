<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\YoutubeVideo;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class VideoController extends Controller
{
    public function __invoke(string $typeVideo, string $videoID)
    {
        $getVideoData = YoutubeVideo::query()
            ->where('status', 1)
            ->where('type', $typeVideo !== 'web-video' ? $typeVideo : 'video');

        $dataCache = $getVideoData->take(10)
            ->OrderBy('created_at', 'desc')->get();
            
        if (auth()->check()) {
            $dataCache = $this->mergeUserVideos($dataCache);
        }

        $data = $getVideoData->firstWhere('video_id', $videoID);

        if ($data === null) {
            abort(404);
        }

        return view('video', [
            'video' => $data,
            'ListVideo' => $dataCache,
        ]);
    }


    private function mergeUserVideos(Collection $dataCache): Collection
    {
        $dataUser = Cache::get('video_user') ?? [];
        $getUserVideo = array_filter($dataUser, function ($userVideo) {
            return $userVideo['user_id'] === Auth::id();
        });

        $listVideo = $dataCache->toArray();
        $mergedVideo = array_merge($getUserVideo, $listVideo);

        return collect($mergedVideo)->unique('video_id')->values();
    }
}
