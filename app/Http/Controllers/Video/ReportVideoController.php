<?php

namespace App\Http\Controllers\Video;

use App\Http\Controllers\Controller;
use App\Http\Requests\Video\ReportVideoRequest;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ReportVideoController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ReportVideoRequest $request)
    {
        $validate = $request->validated();
        $re = $this->checkLinkStatus(route('video.index', ['video' => $validate['url']]));

        if (! $re) {
            return redirect()->route('home')->with('success', 'Report success');
        }

        return redirect()->route('home')->with('error', 'Video Stable');
    }

    public function checkLinkStatus($url)
    {
        try {
            $client = new Client();
            $response = $client->get($url);

            $statusCode = $response->getStatusCode();

            if ($statusCode == 200) {
                return true;
            } else {
                return;
            }
        } catch (\Exception $e) {
            return;
        }
    }
}
