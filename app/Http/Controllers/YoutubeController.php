<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\VideoStatus;
use App\Http\Requests\VideoRequest;
use App\Models\YoutubeVideo;
use App\Settings\APiVideo;
use GuzzleHttp\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class YoutubeController extends Controller
{
    private string $type = 'video';

    public function index()
    {
        $getVideo = $this->getVideos('video');
        $shortVideo = $this->getVideos('shorts');

        return view('youtube.index', [
            'videos' => $getVideo,
            'shortVideo' => $shortVideo,
        ]);
    }

    public function getVideo(VideoRequest $request): RedirectResponse
    {
        $validate = $request->validated();
        $videoID = $this->getVideoId($validate['url']);

        if (!$videoID) {
            return back()->with('error', 'Invalid video ID');
        }

        $apiUrl = (new APiVideo())->url . '/api/getVideo?url=' . $videoID;
        $client = new Client();

        $dataCache = YoutubeVideo::query()->get();
        $data = $dataCache->firstWhere('video_id', $videoID);

        if (!$data) {
            try {
                $response = $client->request('GET', $apiUrl);
                $responseData = json_decode($response->getBody()->__toString(), true);

                if (isset($responseData['error'])) {
                    return Redirect::route('home')->with('error', 'Error system');
                }

                $data = [
                    'video_id' => $videoID,
                    'title' => $responseData['title'] ?? null,
                    'url_video' => $responseData['url_video'] ?? null,
                    'thumbnail' => $responseData['thumbnail'] ?? null,
                    'type' => $this->type,
                ];

                YoutubeVideo::updateOrCreate(['video_id' => $videoID], $data);
            } catch (\Exception $e) {
                return Redirect::route('home')->with('error', 'Error system');
            }
        }

        return Redirect::route('video.index', ['video' => $videoID, 'type_video' => $this->type]);
    }

    private function getVideoId($url): string
    {
        $urlParts = parse_url($url);
        $pathParts = explode('/', trim($urlParts['path'] ?? '', '/'));

        if (isset($urlParts['query'])) {
            parse_str($urlParts['query'], $queryParameters);
            $this->type = 'video';
            if (isset($queryParameters['v'])) {
                return $queryParameters['v'];
            }
        }

        foreach (['shorts', 'live'] as $type) {
            if (in_array($type, $pathParts)) {
                $this->type = $type;

                return $pathParts[array_search($type, $pathParts) + 1] ?? '';
            }
        }

        return $pathParts[0] ?? '';
    }

    private function getVideos($type)
    {
        return YoutubeVideo::query()
            ->where('status', VideoStatus::Active)
            ->where('type', $type)
            ->paginate(12)
            ->withQueryString();
    }
}
