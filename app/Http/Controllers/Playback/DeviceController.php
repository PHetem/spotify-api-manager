<?php

namespace App\Http\Controllers\Playback;

use Exception;
use Illuminate\Support\Facades\Http;

class DeviceController
{
    private static function getDevices($token) {
        $url = config('constants.spotify_base_url') . 'me/player/devices';

        return Http::withToken($token)->get($url)->json();
    }

    public static function getActiveDeviceID($token) {
        $devices = self::getDevices($token)['devices'] ?? [];

        $activeDevice = array_search(true, array_column($devices, 'is_active', 'id'));

        if (is_null($activeDevice) || !$activeDevice)
            throw new Exception('No active device available for user');

        return $activeDevice;
    }
}
