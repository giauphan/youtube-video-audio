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
                $response = $client->request('GET', $apiUrl);

                $responseData = json_decode($response->getBody(), true);

                $file_content = $responseData['file_content'];

                return view('youtube.index', [
                    "video_content" => $file_content,
                ]);
            } catch (\Exception $e) {
                return  back()->with('error', "Error retrieving video and audio URLs.");
            }
        }
    }
}
