<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class VideoSaveController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $getvideo = Cache::get('video_user', []);
        $perPage = 12;
        $currentPage = request('page', 1);
        $paginatedData = array_slice($getvideo, ($currentPage - 1) * $perPage, $perPage);
        $filesByDatabase = new LengthAwarePaginator($paginatedData, count($getvideo), $perPage, $currentPage, ['path' => $request->url()]);

        return view('User.video', [
            'getvideo' => $filesByDatabase]);
    }
}
