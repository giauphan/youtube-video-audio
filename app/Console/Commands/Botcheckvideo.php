<?php

namespace App\Console\Commands;

use App\Jobs\ReportJob;
use App\Models\YoutubeVideo;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class Botcheckvideo extends Command
{
    protected $signature = 'bot:check-video';

    protected $description = 'Command description';

    public function handle()
    {
        $this->info('Starting bot refresh link video...'.now());
        $getVideo = YoutubeVideo::query()->get();
        $N = 0;
        while ($N < 2) {
            foreach ($getVideo as $videos) {
                if (! $this->checkLinkStatus($videos->url_video)) {
                    ReportJob::dispatch($videos['video_id'], $videos['type'])->delay(Carbon::now()->addSeconds(5));
                }
            }
            $N++;
        }
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
        }

        return true;
    }
}
