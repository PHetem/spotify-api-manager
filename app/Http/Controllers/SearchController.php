<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Playback\PlaybackController;
use App\Models\Playback\Tracklist\Tracklist;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SearchController extends PlaybackController
{
    public function getTracks(Request $request) {
        if (!isset($request['query']))
            throw new Exception('Query not set');

        $params = ['q' => $request['query'], 'type' => 'track', 'limit' => 10];
        $token = APITokenController::getUserAccess()->token;

        $url = 'https://api.spotify.com/v1/search';
        $url .= '?' . http_build_query($params);

        return new Tracklist(Http::withToken($token)->get($url)->json()['tracks']['items'] ?? []);
    }
}
