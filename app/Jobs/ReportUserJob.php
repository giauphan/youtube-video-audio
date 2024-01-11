<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Models\User;
use App\Settings\APiVideo;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Redis;

class ReportUserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $url;

    public string $type;

    public User $user;

    public function __construct(string $url, string $type, User $user)
    {
        $this->type = $type;
        $this->url = $url;
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $datacache = Redis::exists('video_user') ? json_decode(Redis::get('video_user'), true) : [];

        $responseData = $this->fetchVideoData();

        if (isset($datacache[$this->url])) {
            unset($datacache[$this->url]);
        }
        $data = [
            'id' => $this->url,
            'user_id' => $this->user->id,
            'title' => $responseData['title'] ?? null,
            'url_video' => $responseData['url_video'] ?? null,
            'thumbnail' => $responseData['thumbnail'] ?? null,
            'type' => $this->type,
        ];

        $dataUser = Redis::exists('video_user') ? json_decode(Redis::get('video_user'), true) : [];

        $dataUser[$this->url] = $data;
        Redis::set('video_user', json_encode($dataUser));
        Redis::expire('video_user', 7200);
    }

    private function fetchVideoData(): ?array
    {
        $client = new Client();
        $responseData = null;
        $times = 0;
        do {
            $setting = new APiVideo();
            $apiUrl = $setting->url.'/api/getVideo?url='.$this->url;
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
