<?php

namespace App\Jobs;

use App\Settings\APiVideo;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ReportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $url;

    public string $type;

    public function __construct(string $url, string $type)
    {
        $this->type = $type;
        $this->url = $url;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $datacache = Cache::get('video');
        $responseData = $this->fetchVideoData();

        $datacache = Cache::get('video');
        if (isset($datacache[$this->url])) {
            unset($datacache[$this->url]);
        }
        $data = [
            'id' => $this->url,
            'title' => $responseData['title'] ?? null,
            'url_video' => $responseData['url_video'] ?? null,
            'thumbnail' => $responseData['thumbnail'] ?? null,
            'type' => $this->type,
        ];
        if (Auth::user()) {
            $dataUser = Cache::get('video_user') ?? [];

            $dataUser[$this->url] = $data;
            Cache::put('video_user', $dataUser, now()->addHours(4));
        } else {
            $datacache[$this->url] = $data;
            Cache::put('video', $datacache, now()->addHours(2));
        }
    }

    private function fetchVideoData(): ?array
    {
        $client = new Client();
        $responseData = null;
        $times = 0;
        do {
            $setting = new APiVideo();
            $apiUrl = $setting->url . '/api/getVideo?url=' . $this->url;
            $response = $client->request('GET', $apiUrl);
            $responseData = json_decode($response->getBody()->__toString(), true);
            if ($times == 5) {
                break;
            }
            $times++;
        } while ($this->checkLinkStatus($responseData['url_video']));

        return $responseData;
    }

    public function checkLinkStatus($url)
    {
        try {
            $client = new Client(['timeout' => 2]);

            $client->get($url);
        } catch (\Exception $e) {
            if ($e->getCode() == 0) {
                return false;
            }

            return true;
        }
    }
}
