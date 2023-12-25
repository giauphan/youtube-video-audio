<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class getvideo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:video {url}';

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
        $videoUrl = $this->argument('url');
        $command = 'youtube-dl --verbose -g '.$videoUrl;

        // Execute the command
        $output = shell_exec($command);

        // Split the output into an array of URLs
        $urls = explode(PHP_EOL, trim($output));

        // Now $urls should contain two URLs: video and audio
        if (count($urls) >= 2) {
            $videoUrl = $urls[0];
            $audioUrl = $urls[1];
            // $videoContents = file_get_contents($videoUrl);
            dd($audioUrl, Http::get($videoUrl));
            // Output or process the video and audio URLs as needed
            $this->info("Video URL: $videoUrl");
            $this->info("Audio URL: $audioUrl");
        } else {
            // Handle the case where the expected number of URLs is not returned
            $this->error('Error retrieving video and audio URLs.');
        }
    }
}
