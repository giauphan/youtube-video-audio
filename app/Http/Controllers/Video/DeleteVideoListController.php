<?php

namespace App\Http\Controllers\Video;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class DeleteVideoListController extends Controller
{
    public function __invoke(Request $request)
    {
        $cacheVideo =  Redis::exists('video_user') ? json_decode(Redis::get('video_user') , true) : [];

        if (isset($cacheVideo[$request->input('video_id')])) {
            unset($cacheVideo[$request->input('video_id')]);
            Redis::set('video_user', $cacheVideo);

            return redirect()->route('user.video.index')->with('success', 'Delete video in list succes');
        }

        return back()->with('error', 'Video not found');
    }
}
