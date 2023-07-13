<?php

namespace App\Http\Controllers\Playback;

use Exception;
use Illuminate\Support\Facades\Http;
use Symfony\Component\Routing\Exception\InvalidParameterException;

class DeviceController extends PlaybackController
{
    public function getDevices() {
        $url = config('constants.spotify_base_url') . 'me/player/devices';

        $devices = Http::withToken($this->token)->get($url)->json()['devices'] ?? [];

        foreach ($devices as $key => $device) {
            // Direct access required to change original array and not reflection
            $devices[$key]['icon'] = $this->getDeviceIcon($device);
        }

        return $devices;
    }

    public function getActiveDeviceID() {
        $devices = $this->getDevices();

        return array_search(true, array_column($devices, 'is_active', 'id'));
    }

    public function hasActiveDevice() {
        $activeDevice = $this->getActiveDeviceID();

        return (!is_null($activeDevice) && $activeDevice);
    }

    public function getDeviceIcon($device) {
        $icon = '';

        switch ($device['type']) {
            case 'Smartphone':
            default:
                $icon = 'Smartphone';
                break;

            case 'Computer':
                $icon = 'Computer';
                break;

            case 'Speaker':
                $icon = 'Speaker';
                break;
        }

        return asset('img/device/' . $icon . '.png');;
    }

    public function setDevice() {

        if (!isset($this->data['selected_device']))
            throw new InvalidParameterException('Missing device ID');

        $url = config('constants.spotify_base_url') . 'me/player';
        $data = json_encode(['device_ids' => [$this->data['selected_device']]]);

        Http::withToken($this->token)->withBody($data)->put($url);
    }
}
