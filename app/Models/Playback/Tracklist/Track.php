<?php

namespace App\Models\Playback\Tracklist;

use App\Helpers\ImageHelper;
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
            $this->image = ImageHelper::getImageBySize($track['album']['images'], 'small');
        } else {
            $this->artist = $track['show']['name'];
            $this->image = ImageHelper::getImageBySize($track['images'], 'small');
        }
    }
}
