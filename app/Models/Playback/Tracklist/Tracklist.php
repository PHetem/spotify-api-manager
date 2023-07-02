<?php

namespace App\Models\Playback\Tracklist;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tracklist extends Model
{
    use HasFactory;

    public $tracks;

    public function __construct($queue) {
        $this->mapTracks($queue);
    }

    public function mapTracks($queue) {
        foreach ($queue as $track) {
            $this->tracks[] = new Track($track);
        }
    }
}
