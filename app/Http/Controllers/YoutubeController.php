<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\VideoRequest;
use App\Models\YoutubeVideo;
use App\Settings\APiVideo;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class YoutubeController extends Controller
{
    public string $type = 'video';

    public function index(Request $request)
    {
        $getvideo = YoutubeVideo::query()
            ->paginate(12)
            ->withQueryString();

        return view('youtube.index', [
            'getvideo' => $getvideo,
        ]);
    }

    public function getVideo(VideoRequest $request)
    {
        $validate = $request->validated();
        $videoUrl = $validate['url'];
        $videoID = $this->getVideoId($videoUrl);
        if (! ($videoID)) {
            return back()->with('error', 'Invalid video ID');
        }
        $setting = new APiVideo();
        $apiUrl = $setting->url.'/api/getVideo?url='.$videoID;
        $client = new Client();

        $dataCache = YoutubeVideo::query()->get();
        $data = $dataCache->firstWhere('video_id', $videoID);

        if (! $data) {
            try {
                $response = $client->request('GET', $apiUrl);
                $responseData = json_decode($response->getBody()->__toString(), true);

                if (isset($responseData['error'])) {
                    return redirect()->route('home')->with('error', 'Error system');
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
                return redirect()->route('home')->with('error', 'Error system');
            }
        }

        return redirect()->route('video.index', ['video' => $videoID]);
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
