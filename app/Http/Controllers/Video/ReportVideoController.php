<?php

namespace App\Http\Controllers\Video;

use App\Http\Controllers\Controller;
use App\Http\Requests\Video\ReportVideoRequest;
use App\Jobs\ReportJob;
use Carbon\Carbon;

class ReportVideoController extends Controller
{
    public function __invoke(ReportVideoRequest $request)
    {
        $validated = $request->validated();

        ReportJob::dispatch($validated['video_id'], $validated['type'])->delay(Carbon::now()->addSeconds(5));

        return redirect()->route('video.index', ['video' => $validated['video_id'], 'type_video' => $validated['type'] ?? 'video'])->with('success', 'Report success');
    }
}
