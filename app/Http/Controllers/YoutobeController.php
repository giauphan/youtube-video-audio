<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class YoutobeController extends Controller
{
    public function getVideo(Request $request)
    {
        if ($request->has('url')) {
            $apiUrl = 'https://api.pdf.t4tek.tk/api/getVideo?url=' . urlencode($request->input('url'));

            $client  = new Client();
            try {
                // Make GET request to the API
                $response = $client->request('GET', $apiUrl);

                // Parse JSON response
                $responseData = json_decode($response->getBody(), true);

                // Extract viddeo and audio URLs
                $videoUrl = $responseData['url_video'] ?? null;
                $audioUrl = $responseData['url_audio'] ?? null;

                // Do something with the URLs (e.g., return them)
                return view('youtube.index', [
                    "url_video" => $videoUrl,
                    'url_audio' => $audioUrl
                ]);
            } catch (\Exception $e) {
                return  back()->with('error', "Error retrieving video and audio URLs.");
            }
        }
    }
}
