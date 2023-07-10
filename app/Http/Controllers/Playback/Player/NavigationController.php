<?php

namespace App\Http\Controllers\Playback\Player;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Playback\DeviceController;
use App\Http\Controllers\Playback\PlaybackController;
use App\Models\Media\Podcast;
use App\Models\Media\Track;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NavigationController extends PlaybackController
{
    public function changeTrack(Request $request) {
        $url = config('constants.spotify_base_url') . 'me/player/' . $request['action'];
        $url .= '?' . http_build_query(['device_id' => DeviceController::getActiveDeviceID($this->token)]);

        Http::withToken($this->token)->post($url);

        return $this->renderPlayer();
    }

    public function getCurrentTrack() {
        $url = config('constants.spotify_base_url') . 'me/player/currently-playing';
        $data = ['additional_types' => 'episode'];

        $response = Http::withToken($this->token)->get($url, $data)->json();

        $trackType = $response['currently_playing_type'] ?? null;
        $trackData = $response['item'] ?? null;

        return $this->mapTrack($trackType, $trackData);
    }

    private function mapTrack($trackType, $trackData) {
        $trackName = strlen($trackData['name']) > 80 ? substr($trackData['name'], 0, 77) . '...' : $trackData['name'];

        if ($trackType == 'track') {
            $item = new Track();
            $item->name = $trackName . ' - ' . $trackData['artists'][0]['name'];
            $item->imageURL = ImageHelper::getImageBySize($trackData['album']['images'], 'large');
        } elseif ($trackType == 'episode') {
            $item = new Podcast();
            $item->name = $trackName . ' - ' . $trackData['show']['name'];
            $item->imageURL = ImageHelper::getImageBySize($trackData['images'], 'large');
        } else {
            return null;
        }

        $item->URL = $item::getBaseURL() . $trackData['id'];
        $item->spotifyID = $trackData['id'];

        return $item;
    }
}
