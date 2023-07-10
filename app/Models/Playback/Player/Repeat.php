<?php

namespace App\Models\Playback\Player;

class Repeat extends State {
    public function __construct($state) {
        $this->state = $state;
        $this->image = $this->baseImgPath;

        if ($state == 'off') {
            $this->image .= 'repeat-grey.png';
            $this->value = 'context';
        } elseif ($state == 'context') {
            $this->image .= 'repeat.png';
            $this->value = 'track';
        } else {
            $this->image .= 'repeat-one.png';
            $this->value = 'off';
        }

        $this->urlSuffix = 'repeat';
    }
}
