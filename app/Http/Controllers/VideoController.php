<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class VideoController extends Controller
{
    public function __invoke(string $videoID)
    {

        $datacache = Cache::get('video') ?? [];
        if (auth()->user()) {
            $datauser = Cache::get('video_user') ?? [];
            $getvideoUser = array_filter($datauser, function ($datauser) {
                return $datauser['user_id'] === Auth::user()->id;
            });
            $datacache = array_merge($datacache, $getvideoUser);

        }
        $data = (is_array($datacache) && array_key_exists($videoID, $datacache)) ? $datacache[$videoID] : null;

        if ($data === null) {
            abort(404);
        }

        return view('video', [
            'video' => $data,
            'ListVideo' => $getvideoUser ?? $datacache,
        ]);
    }
}
