<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class VideoListController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $getvideo = Cache::get('video_user') ?? []; 
        $getvideoUser = array_filter($getvideo, function ($getvideo) use($request) {
          ;
            return $getvideo['user_id'] ===$request->user()->id;
        });
        $perPage = 12;
        $currentPage = request('page', 1);
        $paginatedData = array_slice($getvideoUser, ($currentPage - 1) * $perPage, $perPage);
        $filesByDatabase = new LengthAwarePaginator($paginatedData, count($getvideoUser), $perPage, $currentPage, ['path' => $request->url()]);

        return view('User.video', [
            'getvideo' => $filesByDatabase,
        ]);
    }
}
