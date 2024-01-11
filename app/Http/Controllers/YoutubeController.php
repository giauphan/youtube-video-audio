<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\VideoRequest;
use App\Settings\APiVideo;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class YoutubeController extends Controller
{
    public string $type = 'video';

    public function index(Request $request)
    {
        $getvideo = Redis::exists('video') ? json_decode(Redis::get('video'), true) : [];
        $perPage = 12;
        $currentPage = request('page', 1);
        $paginatedData = array_slice($getvideo, ($currentPage - 1) * $perPage, $perPage);
        $filesByDatabase = new LengthAwarePaginator($paginatedData, count($getvideo), $perPage, $currentPage, ['path' => $request->url()]);

        return view('youtube.index', [
            'getvideo' => $filesByDatabase,
        ]);
    }

    public function getVideo(VideoRequest $request)
    {
        $validate = $request->validated();
        try {
            $videoUrl = $validate['url'];
            $videoID = $this->getVideoId($videoUrl);
            if (! ($videoID)) {
                return back()->with('error', 'Invalid video ID');
            }
            $setting = new APiVideo();
            $apiUrl = $setting->url.'/api/getVideo?url='.$videoID;
            $client = new Client();
            $datacache = Redis::exists('video') ? json_decode(Redis::get('video'), true) : [];
            $data = (is_array($datacache) && array_key_exists($videoID, $datacache)) ? $datacache[$videoID] : null;

            if (! $data) {
                $response = $client->request('GET', $apiUrl);
                $responseData = json_decode($response->getBody()->__toString(), true);

                if (isset($responseData['error'])) {
                    return redirect()->route('home')->with('error', 'Error system');
                }

                if (! Auth::user()) {
                    $data = [
                        'id' => $videoID,
                        'title' => $responseData['title'] ?? null,
                        'url_video' => $responseData['url_video'] ?? null,
                        'thumbnail' => $responseData['thumbnail'] ?? null,
                        'type' => $this->type,
                    ];
                    $datacache[$videoID] = $data;
                    Redis::set('video', json_encode($datacache), 'EX', 7200);
                }
                if (Auth::user()) {
                    $data = [
                        'id' => $videoID,
                        'user_id' => auth()->user()->id,
                        'title' => $responseData['title'] ?? null,
                        'url_video' => $responseData['url_video'] ?? null,
                        'thumbnail' => $responseData['thumbnail'] ?? null,
                        'type' => $this->type,
                    ];
                    $dataUser = Redis::exists('video_user') ? json_decode(Redis::get('video_user'), true) : [];

                    $dataUser[$videoID] = $data;
                    Redis::set('video_user', json_encode($dataUser), 'EX', 14400);
                }
            }

            return view('video', [
                'video' => $data,
                'ListVideo' => $datacache,
            ]);
        } catch (\Exception $e) {
            return redirect()->route('home')->with('error', 'Error system');
        }
    }

    private function getVideoId($url)
    {
        $urlParts = parse_url($url);
        $pathParts = explode('/', trim($urlParts['path'] ?? '', '/'));

        if (isset($urlParts['query'])) {
            parse_str($urlParts['query'], $queryParameters);
            $this->type = 'video';

            return $queryParameters['v'] ?? '';
        }

        if (in_array('shorts', $pathParts)) {
            $this->type = 'shorts';

            return $pathParts[array_search('shorts', $pathParts) + 1] ?? '';
        }

        if (in_array('live', $pathParts)) {
            $this->type = 'live';

            return $pathParts[array_search('live', $pathParts) + 1] ?? '';
        }

        return $pathParts[0] ?? '';
    }
}
