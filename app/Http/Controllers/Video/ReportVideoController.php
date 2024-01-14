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

        ReportJob::dispatch($validated['link'], $validated['type'])->delay(Carbon::now()->addSeconds(5));

        return redirect()->route('video.index', ['video' => $validated['link']])->with('success', 'Report success');
    }
}
