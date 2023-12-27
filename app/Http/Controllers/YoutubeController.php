<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\VideoRequest;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class YoutubeController extends Controller
{
    public function index()
    {
        $getvideo = Cache::get('video', []);
        return view('youtube.index', [
            'getvideo' => $getvideo
        ]);
    }

    public function getVideo(VideoRequest $request)
    {
        $validate = $request->validated();
        try {
            $videoUrl = $validate['url'];
            $videoID = $this->getVideoId($videoUrl);
            if (!is_string($videoID)) {
                return back()->with('error', 'Invalid video ID.');
            }
            $apiUrl = 'https://api.pdf.t4tek.tk/api/getVideo?url=' . $videoID;

            $client = new Client();

            $datacache = Cache::get('video');
            $data = array_key_exists($videoID, $datacache) ? $datacache[$videoID] : null;

            if (!$data) {
                $response = $client->request('GET', $apiUrl);
                $responseData = json_decode($response->getBody()->__toString(), true);

                $title = $responseData['title'] ?? null;
                $videoUrl = $responseData['url_video'] ?? null;
                $thumbnail = $responseData['thumbnail'] ?? null;
                $data = $datacache[$videoID] = [
                    'title' => $title,
                    'url_video' => $videoUrl,
                    'thumbnail' => $thumbnail,
                ];
                Cache::put('video', $datacache, now()->addHours(4));
            }

            return view('video', $data);
        } catch (\Exception $e) {
            return redirect()->route('home')->with('error', 'Error system');
        }
    }

    public function getVideoId($url)
    {
        $urlParts = parse_url($url);

        if (isset($urlParts['query'])) {
            parse_str($urlParts['query'], $queryParameters);

            return $queryParameters['v'] ?? '';
        }

        if (isset($urlParts['path'])) {
            $pathParts = explode('/', trim($urlParts['path'], '/'));

            if (in_array('shorts', $pathParts)) {
                $index = array_search('shorts', $pathParts);

                return $pathParts[$index + 1] ?? '';
            }
        }

        return '';
    }
}
