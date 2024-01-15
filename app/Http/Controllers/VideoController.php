<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\YoutubeVideo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class VideoController extends Controller
{
    public function __invoke(string $type_video,string $videoID)
    {

        $dataCache = YoutubeVideo::query()
            ->where('status', 1)
            ->where('type',  $type_video != "web-video" ? $type_video : "video")
            ->get();
        if (auth()->user()) {
            $datauser = Cache::get('video_user') ?? [];
            $getVideoUser = array_filter($datauser, function ($datauser) {
                return $datauser['user_id'] === Auth::user()->id;
            });
            $listVideo = $dataCache->toArray();
            $indexVideo = array_merge($getVideoUser, $listVideo);
            $dataCache = collect($indexVideo)->unique('video_id')->values();
        }
        $data = $dataCache->firstWhere('video_id', $videoID);

        if ($data === null) {
            abort(404);
        }

        return view('video', [
            'video' => $data,
            'ListVideo' => $dataCache,
        ]);
    }
}
