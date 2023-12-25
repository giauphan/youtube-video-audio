<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class YoutubeController extends Controller
{
    public function index()
    {
        return view('video');
    }

    public function getVideo(Request $request)
    {
        if ($request->has('url')) {
            $videoUrl = $request->input('url');
            $apiUrl = 'https://api.pdf.t4tek.tk/api/getVideo?url=' . urlencode($videoUrl);

            $urlParts = parse_url($videoUrl);
            parse_str($urlParts['query'], $queryParameters);
            $videoId = $queryParameters['v'] ?? '';

            $client = new Client();

            try {
                $data = Cache::get($videoId);

                if (!$data) {
                    $response = $client->request('GET', $apiUrl);
                    $responseData = json_decode($response->getBody(), true);

                    $title = $responseData['title'] ?? null;
                    $videoUrl = $responseData['url_video'] ?? null;
                    $data = [
                        'title' => $title,
                        'url_video' => $videoUrl,
                    ];

                    Cache::put($videoId, $data, now()->addMinutes(30));
                }

                return view('youtube.index', $data);
            } catch (\Exception $e) {
                return back()->with('error', 'Error retrieving video and audio URLs.');
            }
        }
    }
}
