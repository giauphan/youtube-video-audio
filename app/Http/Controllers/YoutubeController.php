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

        return view('video');
    }

    public function getVideo(VideoRequest $request)
    {
        $validate = $request->validated();
        try {
            $videoUrl = $validate['url'];
            $videoId = $this->getVideoId($videoUrl);
            if (!$videoId) {
                return back()->with('error', 'Error retrieving video  URLs.');
            }
            $apiUrl = 'https://api.pdf.t4tek.tk/api/getVideo?url=' . $videoId;

            $client = new Client();

            $getcache = Cache::get('video');

            $data = $getcache['video'][$videoId] ?? false;
            if (!$data) {
                $response = $client->request('GET', $apiUrl);
                $responseData = json_decode($response->getBody()->__toString(), true);

                $title = $responseData['title'] ?? null;
                $videoUrl = $responseData['url_video'] ?? null;
                $datacache = [
                    $videoId =>  [
                        'title' => $title,
                        'url_video' => $videoUrl,
                    ]
                ];
                $data = $datacache[$videoId];
                Cache::put('video', $datacache, now()->addHours(4));
            }

            return view('video', $data);
        } catch (\Exception $e) {
            return back()->with('error', 'Error system');
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
