<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;

class getvideo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:video';

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

        $client = new Client(['timeout' => 2]);
        try {
            //code...
            $response = $client->get('https://rr2---sn-5uaeznl6.googlevideo.com/videoplayback?expire=1704179702&ei=lmOTZY_KLaO__9EP6Y-RiA8&ip=34.148.38.240&id=o-AP6bEITuAqEZedyHIDSBGVBhw2XdK9qUtFi4OQ5FLITu&itag=18&source=youtube&requiressl=yes&xpc=EgVo2aDSNQ%3D%3D&mh=QZ&mm=31%2C26&mn=sn-5uaeznl6%2Csn-a5meknd6&ms=au%2Conr&mv=u&mvi=2&pl=20&spc=UWF9f641FwIpJs7F_icdx7QdAVsTouLEJGbBIFi9ew&vprv=1&svpuc=1&mime=video%2Fmp4&ns=_eVdOaEX5d-xzzeD-QKuAy8Q&gir=yes&clen=62209828&ratebypass=yes&dur=2714.064&lmt=1704085745593432&mt=1704157121&fvip=4&fexp=24007246&c=WEB&txp=5319224&n=CIGbMmt54_lHKZJ&sparams=expire%2Cei%2Cip%2Cid%2Citag%2Csource%2Crequiressl%2Cxpc%2Cspc%2Cvprv%2Csvpuc%2Cmime%2Cns%2Cgir%2Cclen%2Cratebypass%2Cdur%2Clmt&lsparams=mh%2Cmm%2Cmn%2Cms%2Cmv%2Cmvi%2Cpl&lsig=AAO5W4owRQIhALKqTR-i9ZTwiVxNWKcy3Po-oUKOhoecB3IYiDOBaQKRAiAa81yMrtV-CDbruCfzn9uRuId2-dJSzalpDd-wc7XefQ%3D%3D&sig=AJfQdSswRQIgYU1ouELA6FC_h33Pb9iSuXWA4N3mGLHA27PgvFlK1uACIQDZHvUb4I6lFP5vQWPILSQl9d0yjqyew40ta2MHSipm7Q==');

            $statusCode = $response->getStatusCode();

            if ($statusCode == 200) {
                return true;
            } else {
                return;
            }
        } catch (\Exception $e) {
            dd('timesout', $e->getCode());
        }
    }
}
