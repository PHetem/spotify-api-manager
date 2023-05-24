<?php

namespace App\Http\Controllers\Playback;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NavigationController extends PlaybackController
{
    public function changeTrack(Request $request) {
        $url = 'https://api.spotify.com/v1/me/player/' . $request['action'];
        $url .= '?' . http_build_query(['device_id' => $this->getActiveDeviceID()]);

        Http::withToken($this->token)->post($url);

        return redirect()->route('customers.details', $this->customerID);
    }
}
