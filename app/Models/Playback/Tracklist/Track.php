<?php

namespace App\Models\Playback\Tracklist;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    use HasFactory;

    public $name;
    public $artist;
    public $image;
    public $uri;

    public function __construct($track) {
        $this->name = $track['name'];
        $this->uri = $track['uri'];

        if ($track['type'] == 'track') {
            $this->artist = $track['artists'][0]['name'];
            $this->image = $track['album']['images'][0]['url'];
        } else {
            $this->artist = $track['show']['name'];
            $this->image = $track['images'][0]['url'];
        }
    }
}
