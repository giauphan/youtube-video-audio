<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Response;
use YoutubeDl\Options;
use YoutubeDl\YoutubeDl;

class VideoController extends Controller
{
    public function index()
    {
        return view('video');
    }

    public function showVideo($videoName)
    {
        $file = Cache::get($videoName);
        $fileContent = base64_decode($file['filecontent']);

        return Response::make($fileContent, 200, [
            'Content-Type' => $file['type'],
            'Content-Disposition' => 'inline; filename="'.$videoName.'"',
        ]);
    }

    public function VideoYTb(Request $request)
    {
        // Create a new instance of YoutubeDl
        $yt = new YoutubeDl();

        // Set the path to the youtube-dl binary
        $yt->setBinPath('/usr/bin/youtube-dl');

        $videoUrl = 'https://www.youtube.com/watch?v=Hpc-w6NVFC8';
        $urlParts = parse_url($videoUrl);
        parse_str($urlParts['query'], $queryParameters);
        $videoId = isset($queryParameters['v']) ? $queryParameters['v'] : '';
        // Set the download path
        $downloadPath = public_path('/storage');

        $collection = $yt->download(
            Options::create()
                ->downloadPath($downloadPath)
                ->format('mp4')
                ->url($videoUrl)
        );

        foreach ($collection->getVideos() as $video) {
            if ($video->getError() !== null) {
                return back()->with('error', "Error downloading video: {$video->getError()}.");
            } else {
                $file = $video->getFile();
                $fileContent = file_get_contents($file->getPathname());
                Cache::put($videoId, $fileContent);

                return response($fileContent)->header('Content-Type', 'video/mp4');
            }
        }
    }
}
