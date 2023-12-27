<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class VideoController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(string $videoID)
    {
        $datacache = Cache::get('video',[]);

        $data = $datacache[$videoID] ?? false;
        if (!$data ) {
        abort(404);
        }
       return view('video', $data);
    }
}
