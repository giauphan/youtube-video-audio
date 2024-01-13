<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\YoutubeVideo;

class VideoController extends Controller
{
    public function __invoke(string $videoID)
    {

        $dataCache = YoutubeVideo::query()->get();
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
