<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\VideoRequest;
use App\Settings\APiVideo;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class YoutubeController extends Controller
{
    public string $type = 'video';

    public function index(Request $request)
    {
        $getvideo = Cache::get('video', []);

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
                return back()->with('error', trans('Invalid video ID.'));
            }
            $setting = new APiVideo();
            $apiUrl = $setting->url.'/api/getVideo?url='.$videoID;
            $client = new Client();
            $datacache = Cache::get('video');
            $data = (is_array($datacache) && array_key_exists($videoID, $datacache)) ? $datacache[$videoID] : null;

            if (! $data) {
                $response = $client->request('GET', $apiUrl);
                $responseData = json_decode($response->getBody()->__toString(), true);

                $data = [
                    'id' => $videoID,
                    'title' => $responseData['title'] ?? null,
                    'url_video' => $responseData['url_video'] ?? null,
                    'thumbnail' => $responseData['thumbnail'] ?? null,
                    'type' => $this->type,
                ];
                if (Auth::user()) {
                    $dataUser = Cache::get('video_user') ?? [];

                    $dataUser[$videoID] = $data;
                    Cache::put('video_user', $dataUser, now()->addHours(4));
                } else {
                    $datacache[$videoID] = $data;
                    Cache::put('video', $datacache, now()->addHours(2));
                }
            }

            return view('video', [
                'video' => $data,
            ]);
        } catch (\Exception $e) {
            return redirect()->route('home')->with('error', trans('Error system'));
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
