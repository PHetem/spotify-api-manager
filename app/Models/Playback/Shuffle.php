<?php

namespace App\Models\Playback;

class Shuffle extends State {
    public function __construct($state) {
        $this->state = $state;
        $this->image = $this->baseImgPath;

        if ($state == 'on') {
            $this->image .= 'shuffle.png';
            $this->value = 'off';
        } else {
            $this->image .= 'shuffle-grey.png';
            $this->value = 'on';
        }

        $this->urlSuffix = 'shuffle';
    }
}
