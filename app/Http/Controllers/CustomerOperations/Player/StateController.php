<?php

namespace App\Http\Controllers\CustomerOperations\Player;

use App\Http\Controllers\CustomerOperations\DeviceController;
use App\Http\Controllers\CustomerOperations\PlaybackController;
use App\Models\Playback\Player\Playing;
use App\Models\Playback\Player\Repeat;
use App\Models\Playback\Player\Shuffle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class StateController extends PlaybackController
{
    public function switchState(Request $request) {
        $actionType = $request['action'];
        $class = ($actionType == 'shuffle' ? Shuffle::class : ($actionType == 'repeat' ? Repeat::class : Playing::class));

        $data = (new $class($request['state']))->getParams(app(DeviceController::class)->getActiveDeviceID());
        Http::withToken($this->token)->withHeaders($data['headers'])->put($data['url'], $data['parameters']);

        return $this->renderPlayer();
    }

    public function getState() {
        $url = config('constants.spotify_base_url') . 'me/player';

        $result = Http::withToken($this->token)->get($url)->json();

        $state['playingState'] = (new Playing(isset($result['is_playing']) && $result['is_playing'] ? 'on' : 'off'));
        $state['shuffleState'] = (new Shuffle(isset($result['is_playing']) && $result['shuffle_state'] ? 'on' : 'off'));
        $state['repeatState'] = (new Repeat($result['repeat_state'] ?? 'off'));

        return $state;
    }
}
