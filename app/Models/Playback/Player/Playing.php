<?php

namespace App\Models\Playback\Player;

class Playing extends State {
    public function __construct($state) {
        $this->state = $state;
        $this->image = $this->baseImgPath;

        if ($state == 'on') {
            $this->urlSuffix = 'play';
            $this->image .= 'pause.png';
            $this->value = 'off';
        } else {
            $this->urlSuffix = 'pause';
            $this->image .= 'play.png';
            $this->value = 'on';
        }

        $this->headers = ['Content-Type' => 'application/json'];
    }
}
