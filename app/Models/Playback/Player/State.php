<?php

namespace App\Models\Playback\Player;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $baseImgPath = 'img/player/';
    protected $baseURL = 'https://api.spotify.com/v1/me/player/';
    protected $route = 'customers.details.playback.state';
    protected $image = '';
    protected $state = [];
    protected $headers = [];
    protected $value = [];
    protected $urlSuffix = [];

    public function getParams($deviceID) {
        $parameters['device_id'] = $deviceID;

        $query['state'] = $this->getStateParam($this->state);
        $query['device_id'] = $deviceID;

        $url = $this->baseURL . $this->urlSuffix . '?' . http_build_query($query);

        return ['url' => $url, 'headers' => $this->headers, 'parameters' => $parameters];
    }

    public function __get($key) {
        return $this->$key;
    }

    private function getStateParam($state) {
        if (!is_a($this, Repeat::class)) {
            switch ($state) {
                case 'on':
                    $state = 'true';
                    break;

                case 'off':
                    $state = 'false';
                    break;
            }
        }

        return $state;
    }
}
