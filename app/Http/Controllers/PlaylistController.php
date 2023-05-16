<?php

namespace App\Http\Controllers;

use App\Models\Playlist;

class PlaylistController extends Controller
{
    public function list($pagination = 30) {
        $playlists = Playlist::paginate($pagination);

        return $playlists;
    }
}
