<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class YoutubeController extends Controller
{
    public function index()
    {
        return view('video');
    }

    public function getVideo(Request $request)
    {
        if ($request->has('url')) {
            $apiUrl = 'https://api.pdf.t4tek.tk/api/getVideo?url='.urlencode($request->input('url'));

            $client = new Client();
            try {
                $response = $client->request('GET', $apiUrl);

                $responseData = json_decode($response->getBody(), true);

                $title = $responseData['title'] ?? null;
                $videoUrl = $responseData['url_video'] ?? null;

                return view('youtube.index', [
                    'title' => $title,
                    'url_video' => $videoUrl,
                ]);
            } catch (\Exception $e) {
                return back()->with('error', 'Error retrieving video and audio URLs.');
            }
        }
    }
}
