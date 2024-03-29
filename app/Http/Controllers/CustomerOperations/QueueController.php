<?php

namespace App\Http\Controllers\CustomerOperations;

use App\Models\Playback\Tracklist\Tracklist;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class QueueController extends PlaybackController
{
    public function renderQueue() {
        return view('tracks.queue.main', ['tracklist' => $this->getQueue(), 'customerID' => $this->customerID]);
    }

    public function getQueue() {
        $url = config('constants.spotify_base_url') . 'me/player/queue';
        return new Tracklist(Http::retry(3, 200)->withToken($this->token)->get($url)->json()['queue'] ?? []);
    }

    public function addToQueue(Request $request) {
        if (!isset($request['uri']))
            throw new Exception('uri not set');

        $url = config('constants.spotify_base_url') . 'me/player/queue';
        $url .= '?' . http_build_query(['uri' => $request['uri']]);

        $data['device_id'] = app(DeviceController::class)->getActiveDeviceID();

        Http::withToken($this->token)->post($url, $data);

        return $this->renderQueue();
    }
}
