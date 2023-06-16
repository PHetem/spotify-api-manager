<?php

namespace App\Http\Controllers\Playback;

use App\Models\Playback\Playing;
use App\Models\Playback\Repeat;
use App\Models\Playback\Shuffle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class StateController extends PlaybackController
{
    public function getPlayback() {
        $data = $this->getState();
        $data['track'] = $data['playingState']->state == 'on' ? $this->getCurrentTrack() : null;

        return $data;
    }

    public function switchState(Request $request) {
        $actionType = $request['action'];
        $class = ($actionType == 'shuffle' ? Shuffle::class : ($actionType == 'repeat' ? Repeat::class : Playing::class));

        $data = (new $class($request['state']))->getParams($this->getActiveDeviceID());
        Http::withToken($this->token)->withHeaders($data['headers'])->put($data['url'], $data['parameters']);

        return view('customer.player.index', ['playback' => $this->getPlayback(), 'customerID' => $this->customerID]);
    }

    private function getState() {
        $url = 'https://api.spotify.com/v1/me/player';

        $result = Http::withToken($this->token)->get($url)->json();

        $state['playingState'] = (new Playing(isset($result['is_playing']) && $result['is_playing'] ? 'on' : 'off'));
        $state['shuffleState'] = (new Shuffle(isset($result['is_playing']) && $result['shuffle_state'] ? 'on' : 'off'));
        $state['repeatState'] = (new Repeat($result['repeat_state'] ?? 'off'));

        return $state;
    }
}
