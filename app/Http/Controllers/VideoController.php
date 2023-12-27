<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;

class VideoController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(string $videoID)
    {
        $datacache = Cache::get('video');
        $data = ( is_array($datacache) &&array_key_exists($videoID, $datacache)) ? $datacache[$videoID] : null;

        if ($data === null) {
            abort(404);
        }

        return view('video', $data);
    }
}
