<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class YoutobeController extends Controller
{
    public function getVideo(Request $request)
    {
        $videoUrl = $request->input('url');
        $command = 'youtube-dl --verbose -g ' . $videoUrl;
        // Execute the command
        $output = shell_exec($command);

        // Split the output into an array of URLs
        $urls = explode(PHP_EOL, trim($output));

        // Now $urls should contain two URLs: video and audio
        if (count($urls) >= 2) {
            $videoUrl = $urls[0];
            $audioUrl = $urls[1];

            return view('youtube.index', [
                "url_video" => $videoUrl,
                'url_audio' => $audioUrl
            ]);
        } else {
            // Handle the case where the expected number of URLs is not returned
            return  back()->with('error', "Error retrieving video and audio URLs.");
        }
    }
}
