<?php

namespace App\Http\Controllers\Playback;

use App\Models\Playback\Playing;
use App\Models\Playback\Repeat;
use App\Models\Playback\Shuffle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class StateController extends PlaybackController
{
    public function switchState(Request $request) {
        $actionType = $request['action'];
        $class = ($actionType == 'shuffle' ? Shuffle::class : ($actionType == 'repeat' ? Repeat::class : Playing::class));

        $data = (new $class($request['state']))->getParams($this->getActiveDeviceID());
        Http::withToken($this->token)->withHeaders($data['headers'])->put($data['url'], $data['parameters']);

        return $this->renderPlayer();
    }
}
