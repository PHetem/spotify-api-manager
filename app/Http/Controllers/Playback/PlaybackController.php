<?php

namespace App\Http\Controllers\Playback;

use App\Http\Controllers\APITokenController;
use App\Http\Controllers\Controller;
use App\Models\Media\Podcast;
use App\Models\Media\Track;
use Exception;
use Illuminate\Support\Facades\Http;

class PlaybackController extends Controller
{
    public static function get($id) {
        $data = self::getState($id);
        $data['track'] = $data['playingState'] ? self::getCurrentTrack($id) : null;

        return $data;
    }

    public static function getState($id) {
        $token = APITokenController::getCustomerAccess($id)->token;
        $url = 'https://api.spotify.com/v1/me/player';

        $result = Http::withToken($token)->get($url)->json();
        $state['playingState'] = self::mapPlayingState($result['is_playing'] ?? false);
        $state['shuffleState'] = self::mapShuffleState($result['shuffle_state'] ?? false);
        $state['repeatState'] = self::mapRepeatState($result['repeat_state'] ?? 'off');

        return $state;
    }

    public static function getCurrentTrack($id) {
        $token = APITokenController::getCustomerAccess($id)->token;
        $url = 'https://api.spotify.com/v1/me/player/currently-playing';
        $data = ['additional_types' => 'episode'];

        $response = Http::withToken($token)->get($url, $data)->json();

        $trackType = $response['currently_playing_type'];
        $trackData = $response['item'];

        $item = [];

        if ($trackType == 'track') {
            $item = new Track();
            $item->name = $trackData['name'] . ' - ' . $trackData['artists'][0]['name'];
            $item->imageURL = $trackData['album']['images'][0]['url'] ?? null;
        } elseif ($trackType == 'episode') {
            $item = new Podcast();
            $item->name = $trackData['name'] . ' - ' . $trackData['show']['name'];
            $item->imageURL = $trackData['images'][0]['url'] ?? null;
        } else {
            return null;
        }

        $item->URL = $item::getBaseURL() . $trackData['id'];
        $item->spotifyID = $trackData['id'];

        return $item;
    }

    public static function switchPlayingState($id, $currentState) {

        $token = APITokenController::getCustomerAccess($id)->token;
        $headers = [];
        $data = [];

        if ($currentState == 'on') {
            $url = 'https://api.spotify.com/v1/me/player/pause';
        } else {
            $url = 'https://api.spotify.com/v1/me/player/play';

            $device = self::getDevices($id)['devices'][0] ?? null;

            if (is_null($device) || !$device['is_active'])
                throw new Exception('No active device available for user');

            $data['device_id'] = $device['id'];
            $headers['Content-Type'] = 'application/json';
        }

        Http::withToken($token)->withHeaders($headers)->put($url, $data);

        return redirect()->route('customers.details', $id);
    }

    public static function switchShuffleState($id, $currentState) {
        $token = APITokenController::getCustomerAccess($id)->token;
        $data = [];

        $url = 'https://api.spotify.com/v1/me/player/shuffle';

        $device = self::getDevices($id)['devices'][0] ?? null;

        if (is_null($device) || !$device['is_active'])
            throw new Exception('No active device available for user');

        $data['device_id'] = $device['id'];
        $data['state'] = ($currentState == 'on' ? 'false' : 'true');

        $url = $url . '?' . http_build_query($data);

        Http::withToken($token)->put($url);

        return redirect()->route('customers.details', $id);
    }

    public static function switchRepeatState($id, $currentState) {
        $token = APITokenController::getCustomerAccess($id)->token;
        $data = [];

        $url = 'https://api.spotify.com/v1/me/player/repeat';

        $device = self::getDevices($id)['devices'][0] ?? null;

        if (is_null($device) || !$device['is_active'])
            throw new Exception('No active device available for user');

        $data['device_id'] = $device['id'];
        $data['state'] = ($currentState == 'off' ? 'context' : ($currentState == 'context' ? 'track' : 'off'));

        $url = $url . '?' . http_build_query($data);

        Http::withToken($token)->put($url);

        return redirect()->route('customers.details', $id);
    }

    public static function nextTrack($id) {
        $token = APITokenController::getCustomerAccess($id)->token;
        $url = 'https://api.spotify.com/v1/me/player/next';

        Http::withToken($token)->post($url);

        return redirect()->route('customers.details', $id);
    }

    public static function previousTrack($id) {
        $token = APITokenController::getCustomerAccess($id)->token;
        $url = 'https://api.spotify.com/v1/me/player/previous';

        Http::withToken($token)->post($url);

        return redirect()->route('customers.details', $id);
    }

    public static function getDevices($id) {
        $token = APITokenController::getCustomerAccess($id)->token;
        $url = 'https://api.spotify.com/v1/me/player/devices';

        return Http::withToken($token)->get($url)->json();
    }

    private static function mapPlayingState($state) {
        $baseImgPath = 'img/player/';

        $playbackState['image'] = $baseImgPath . ($state ? 'pause.png' : 'play.png');
        $playbackState['value'] = $state ? 'on' : 'off';

        return $playbackState;
    }

    private static function mapShuffleState($state) {
        $baseImgPath = 'img/player/';

        $playbackState['image'] = $baseImgPath . ($state ? 'shuffle.png' : 'shuffle-grey.png');
        $playbackState['value'] = $state ? 'on' : 'off';

        return $playbackState;
    }

    private static function mapRepeatState($state) {
        $baseImgPath = 'img/player/';

        $playbackState['image'] = $baseImgPath . ($state == 'off' ? 'repeat-grey.png' : ($state == 'track' ? 'repeat-one.png' : 'repeat.png'));
        $playbackState['value'] = $state;

        return $playbackState;
    }
}
