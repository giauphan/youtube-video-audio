<?php

namespace App\Console\Commands;

use App\Jobs\ReportJob;
use App\Models\YoutubeVideo;
use Carbon\Carbon;
use Illuminate\Console\Command;

class Botcheckvideo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bot:check-video';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting bot refresh link video...'.now());
        $getVideo = YoutubeVideo::query()->get();
        $N = 0;
        while ($N < 2) {

            foreach ($getVideo as $key => $videos) {
                ReportJob::dispatch($videos['video_id'], $videos['type'])->delay(Carbon::now()->addSeconds(5));
            }
            $N++;
        }
    }
}
