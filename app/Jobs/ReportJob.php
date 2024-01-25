<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Enums\VideoStatus;
use App\Models\YoutubeVideo;
use App\Settings\APiVideo;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ReportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $video_id;

    public string $type;

    public function __construct(string $video_id, string $type)
    {
        $this->type = $type;
        $this->video_id = $video_id;
    }

    public function handle(): void
    {
        $responseData = $this->fetchVideoData();

        $data = [
            'video_id' => $this->video_id,
            'title' => $responseData['title'] ?? null,
            'url_video' => $responseData['url_video'] ?? null,
            'thumbnail' => $responseData['thumbnail'] ?? null,
            'type' => $this->type,
        ];

        YoutubeVideo::updateOrCreate(['video_id' => $this->video_id], $data);
    }

    private function fetchVideoData(): ?array
    {
        $client = new Client();
        $responseData = null;
        $times = 0;
        do {
            $setting = new APiVideo();
            $apiUrl = $setting->url.'/api/getVideo?url='.$this->video_id;
            $response = $client->request(
                'GET',
                $apiUrl,
                ['verify' => false]
            );
            $responseData = json_decode($response->getBody()->__toString(), true);
            if ($times == 5) {
                $videoFind = YoutubeVideo::query()->where('video_id')->first();
                if ($videoFind) {
                    $videoFind->update([
                        'status' => VideoStatus::Error,
                    ]);
                }
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
