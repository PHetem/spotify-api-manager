<?php

namespace App\Http\Controllers\Playback;

use Exception;
use Illuminate\Support\Facades\Http;

class DeviceController extends PlaybackController
{
    public function getDevices() {
        $url = config('constants.spotify_base_url') . 'me/player/devices';

        return Http::withToken($this->token)->get($url)->json()['devices'] ?? [];
    }

    public function getActiveDeviceID() {
        $devices = $this->getDevices();

        return array_search(true, array_column($devices, 'is_active', 'id'));
    }

    public function hasActiveDevice() {
        $activeDevice = $this->getActiveDeviceID();

        return (!is_null($activeDevice) && $activeDevice);
    }
}
