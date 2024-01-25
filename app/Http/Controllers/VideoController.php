<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\VideoStatus;
use App\Http\Resources\YoutubeVideoResource;
use App\Models\HistoryVideo;
use App\Models\YoutubeVideo;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class VideoController extends Controller
{
    public function __invoke(string $typeVideo, string $videoID)
    {
        $getVideoData = YoutubeVideo::query()
            ->where('status', VideoStatus::Active)
            ->where('type', $typeVideo !== 'web-video' ? $typeVideo : 'video');

        $dataCache = $getVideoData->take(10)
            ->OrderBy('created_at', 'desc')->get();

        $data = $getVideoData->firstWhere('video_id', $videoID);

        if (auth()->check()) {
            $dataCache = $this->mergeUserVideos($dataCache);
            $history = HistoryVideo::query()
                ->where('youtube_video_id', $data->id)
                ->first();
            if (!$history) {
                   $data->historyVideo()->create([
                    'user_id' => auth()->user()->id
                ]);
            }
        }

        if ($data === null) {
            abort(404);
        }

        $cacheKey = sprintf('post:%s', $data->video_id);
        if (!Cache::has($cacheKey)) {
            $data->increment('view');

            Cache::put($cacheKey, true, 10);
        }


        return view('video', [
            'video' => new YoutubeVideoResource($data),
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
