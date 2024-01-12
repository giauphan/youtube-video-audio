<?php

namespace App\Http\Controllers\Video;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DeleteVideoListController extends Controller
{
    public function __invoke(Request $request)
    {
        $cacheVideo = Cache::get('video_user') ?? [];

        if (isset($cacheVideo[$request->input('video_id')])) {
            unset($cacheVideo[$request->input('video_id')]);
            Cache::put('video_user', $cacheVideo, 1440);

            return redirect()->route('user.video.index')->with('success', 'Delete video in list succes');
        }

        return back()->with('error', 'Video not found');
    }
}
