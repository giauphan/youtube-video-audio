<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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
        $this->info('running');
        $videoUrl = 'https://rr3---sn-5uaeznss.googlevideo.com/videoplayback?expire=1703604607&ei=H52KZfvNGO28_9EP5ty9oAQ&ip=34.148.38.240&id=o-AGMkCo8GWZ26K_T1qCwZVQAlz1YrEMGYIx6TWhXLghfQ&itag=18&source=youtube&requiressl=yes&xpc=EgVo2aDSNQ%3D%3D&mh=q3&mm=31%2C26&mn=sn-5uaeznss%2Csn-a5mlrnls&ms=au%2Conr&mv=u&mvi=3&pl=20&spc=UWF9f8ZZdquLMW2fKKJOws5FsSF6O3VvvhgPllkP1w&vprv=1&svpuc=1&mime=video%2Fmp4&ns=1ZWMwCz89cSxu0Km_x8YB3EQ&gir=yes&clen=258102197&ratebypass=yes&dur=4825.872&lmt=1703533043947465&mt=1703582709&fvip=2&fexp=24007246&c=WEB&txp=4438434&n=lbZ3BHdMUw2_olL&sparams=expire%2Cei%2Cip%2Cid%2Citag%2Csource%2Crequiressl%2Cxpc%2Cspc%2Cvprv%2Csvpuc%2Cmime%2Cns%2Cgir%2Cclen%2Cratebypass%2Cdur%2Clmt&lsparams=mh%2Cmm%2Cmn%2Cms%2Cmv%2Cmvi%2Cpl&lsig=AAO5W4owRAIgRc9lLf1PzB9ihJyZgkhvozKE9_ZfMKMH0SrLgXHL6jECIH4fMDGMRNAvq0vIt6cJp8NYCk4VgTcL4yNDtQcW_owd&sig=AJfQdSswRQIhAMx3RCxE-4bcOI9LR-zIzawkDyLHQ4P1zj3Ucn7m6PReAiBG-E5GXgljgBp9q03dPk0SRYn992YXwntiqu9gz37jXg==';

        // Get the video content
        $videoContent = file_get_contents($videoUrl);
        $this->info($videoContent);
        dd($videoContent);
    }
}
