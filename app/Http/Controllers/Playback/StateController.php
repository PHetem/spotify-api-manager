<?php

namespace App\Http\Controllers\Playback;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class StateController extends PlaybackController
{
    public function getPlayback() {
        $data = $this->getState();
        $data['track'] = $data['playingState']['state'] ? $this->getCurrentTrack() : null;

        return $data;
    }

    public function switchState(Request $request) {
        $data = $this->getParams($request['action'], $request['state']);

        Http::withToken($this->token)->withHeaders($data['headers'])->put($data['url'], $data['parameters']);

        return redirect()->route('customers.details', $this->customerID);
    }

    private function getState() {
        $url = 'https://api.spotify.com/v1/me/player';

        $result = Http::withToken($this->token)->get($url)->json();

        $state['playingState'] = $this->mapState('playing', $result['is_playing'] ?? false);
        $state['shuffleState'] = $this->mapState('shuffle', $result['shuffle_state'] ?? false);
        $state['repeatState'] = $this->mapState('repeat', $result['repeat_state'] ?? 'off');

        return $state;
    }

    private function getParams($type, $state) {
        $headers = [];
        $parameters = [];
        $query['device_id'] = $this->getActiveDeviceID();

        switch ($type) {
            case 'shuffle':
                $query['state'] = ($state == 'on' ? 'false' : 'true');

                $url = 'https://api.spotify.com/v1/me/player/shuffle';
                break;

            case 'repeat':
                $query['state'] = ($state == 'off' ? 'context' : ($state == 'context' ? 'track' : 'off'));

                $url = 'https://api.spotify.com/v1/me/player/repeat';
                break;

            default:
                if ($state == 'on') {
                    $url = 'https://api.spotify.com/v1/me/player/pause';
                } else {
                    $url = 'https://api.spotify.com/v1/me/player/play';

                    $headers['Content-Type'] = 'application/json';
                    $parameters['device_id'] = $query['device_id'];
                }
                break;
        }

        $url .= '?' . http_build_query($query);

        return ['url' => $url, 'headers' => $headers, 'parameters' => $parameters];
    }

    private static function mapState($type, $state) {
        $baseImgPath = 'img/player/';

        $playbackState['state'] = $state;

        switch ($type) {
            case 'shuffle':
                $playbackState['image'] = $baseImgPath . ($state ? 'shuffle.png' : 'shuffle-grey.png');
                $playbackState['value'] = $state ? 'on' : 'off';
                break;

            case 'repeat':
                $playbackState['image'] = $baseImgPath . ($state == 'off' ? 'repeat-grey.png' : ($state == 'track' ? 'repeat-one.png' : 'repeat.png'));
                $playbackState['value'] = $state;
                break;

            default:
                $playbackState['image'] = $baseImgPath . ($state ? 'pause.png' : 'play.png');
                $playbackState['value'] = $state ? 'on' : 'off';
                break;
        }

        return $playbackState;
    }
}
