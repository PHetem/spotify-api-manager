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
        $data['state'] = self::getState($id);
        $data['track'] = $data['state'] ? self::getCurrentTrack($id) : null;

        return $data;
    }

    public static function getState($id) {
        $token = APITokenController::getCustomerAccess($id)->token;
        $url = 'https://api.spotify.com/v1/me/player';

        return Http::withToken($token)->get($url)->json()['is_playing'] ?? false;
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

    public static function switchState($id) {
        $token = APITokenController::getCustomerAccess($id)->token;
        $headers = [];
        $data = [];

        if (self::getState($id)) {
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
}
