<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use App\Models\Customer\Playlist;

class PlaylistController extends Controller
{
    public function list($pagination = 30) {
        $playlists = Playlist::paginate($pagination);

        return $playlists;
    }
}
