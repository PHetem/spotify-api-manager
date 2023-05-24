<?php

namespace App\Http\Controllers\Playback;

use App\Http\Controllers\APITokenController;
use App\Http\Controllers\Controller;
use App\Models\Media\Podcast;
use App\Models\Media\Track;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\Routing\Exception\InvalidParameterException;

class PlaybackController extends Controller
{

    protected $customerID;
    protected $token;

    public function __construct(Request $request) {
        if (!isset($request['id']))
            throw new InvalidParameterException('Missing customer ID');

        $this->customerID = $request['id'];
        $this->token = APITokenController::getCustomerAccess($this->customerID)->token;
    }

    protected function getCurrentTrack() {
        $url = 'https://api.spotify.com/v1/me/player/currently-playing';
        $data = ['additional_types' => 'episode'];

        $response = Http::withToken($this->token)->get($url, $data)->json();

        $trackType = $response['currently_playing_type'];
        $trackData = $response['item'];

        $item = [];

        $trackName = strlen($trackData['name']) > 80 ? substr($trackData['name'], 0, 77) . '...' : $trackData['name'];

        if ($trackType == 'track') {
            $item = new Track();

            $item->name = $trackName . ' - ' . $trackData['artists'][0]['name'];
            $item->imageURL = $trackData['album']['images'][0]['url'] ?? null;
        } elseif ($trackType == 'episode') {
            $item = new Podcast();
            $item->name = $trackName . ' - ' . $trackData['show']['name'];
            $item->imageURL = $trackData['images'][0]['url'] ?? null;
        } else {
            return null;
        }

        $item->URL = $item::getBaseURL() . $trackData['id'];
        $item->spotifyID = $trackData['id'];

        return $item;
    }

    protected function getDevices() {
        $url = 'https://api.spotify.com/v1/me/player/devices';

        return Http::withToken($this->token)->get($url)->json();
    }

    protected function getActiveDeviceID() {
        $device = $this->getDevices()['devices'][0] ?? null;

        if (is_null($device) || !$device['is_active'])
            throw new Exception('No active device available for user');

        return $device['id'];
    }
}
