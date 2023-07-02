<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Playback\PlaybackController;
use App\Models\Playback\Tracklist\Tracklist;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SearchController
{
    public function renderSearch(Request $request) {
        return view('tracks.search.main', ['customerID' => $request['id'] ?? null, 'tracklist' => $request['tracklist'] ?? []]);
    }

    public function getTracks(Request $request) {

        if (!isset($request['query']))
            throw new Exception('Query not set');

        $params = ['q' => $request['query'], 'type' => 'track', 'limit' => 10];
        $token = APITokenController::getUserAccess()->token;

        $url = config('constants.spotify_base_url') . 'search';
        $url .= '?' . http_build_query($params);

        $tracklist = new Tracklist(Http::withToken($token)->get($url)->json()['tracks']['items'] ?? []);

        $request['tracklist'] = $tracklist;

        return $this->renderSearch($request);
    }
}
