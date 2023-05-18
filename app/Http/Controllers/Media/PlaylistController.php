<?php

namespace App\Http\Controllers\Media;

use App\Models\Media\Playlist;
use InvalidArgumentException;

class PlaylistController extends MediaController
{
    public static $model = Playlist::class;

    public static function requestMedia($ids) {
        if (count($ids) > 1)
            throw new InvalidArgumentException('Playlists do not allow multiple ID search');

        return ['playlists' => [parent::requestMedia($ids)]];
    }

    public function list($pagination = 30) {
        $playlists = Playlist::paginate($pagination);

        return $playlists;
    }
}
