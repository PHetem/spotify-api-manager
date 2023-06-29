<?php

namespace App\Http\Controllers\Playback;

use App\Http\Controllers\APITokenController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Customer\CustomerController;
use App\Models\Media\Podcast;
use App\Models\Media\Track;
use App\Models\Playback\Playing;
use App\Models\Playback\Repeat;
use App\Models\Playback\Shuffle;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Laravel\Ui\Presets\React;
use Shmop;
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
        $devices = $this->getDevices()['devices'];

        $activeDevice = array_search(true, array_column($devices, 'is_active', 'id'));

        if (is_null($activeDevice) || !$activeDevice)
            throw new Exception('No active device available for user');

        return $activeDevice;
    }

    private function getState() {
        $url = 'https://api.spotify.com/v1/me/player';

        $result = Http::withToken($this->token)->get($url)->json();

        $state['playingState'] = (new Playing(isset($result['is_playing']) && $result['is_playing'] ? 'on' : 'off'));
        $state['shuffleState'] = (new Shuffle(isset($result['is_playing']) && $result['shuffle_state'] ? 'on' : 'off'));
        $state['repeatState'] = (new Repeat($result['repeat_state'] ?? 'off'));
        $state['queue'] = $this->getQueue();

        return $state;
    }

    public function getPlayback() {
        $data = $this->getState();
        $data['track'] = $data['playingState']->state == 'on' ? $this->getCurrentTrack() : null;

        return $data;
    }

    public function renderPlayer() {
        return view('customer.player.index', ['playback' => $this->getPlayback(), 'customerID' => $this->customerID]);
    }

    public function getQueue() {
        $url = 'https://api.spotify.com/v1/me/player/queue';

        return $this->mapQueue(Http::withToken($this->token)->get($url)->json());
    }

    public function mapQueue($queue) {
        $result = [];

        foreach ($queue['queue'] as $track) {
            $response['name'] = $track['name'];

            if ($track['type'] == 'track') {
                $response['artist'] = $track['artists'][0]['name'];
                $response['image'] = $track['album']['images'][0]['url'];
            } else {
                $response['artist'] = $track['show']['name'];
                $response['image'] = $track['images'][0]['url'];
            }

            $result[] = $response;
        }
        return $result;
    }

    public function addToQueue(Request $request) {
        if (!isset($request['trackID']))
            throw new Exception('trackID not set');

        $url = 'https://api.spotify.com/v1/me/player/queue';
        $url .= '?' . http_build_query(['uri' => 'spotify:track:' . $request['trackID']]);

        $data['device_id'] = $this->getActiveDeviceID();

        Http::withToken($this->token)->post($url, $data);

        return (new CustomerController())->details($this->customerID);
    }
}
