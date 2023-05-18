<?php

namespace App\Http\Controllers\Media;

use App\Models\Media\Album;

class AlbumController extends MediaController
{
    public static $model = Album::class;

    public static function requestMedia($ids) {
        return parent::requestMedia($ids);
    }

    public function list($pagination = 30) {
        $albums = Album::paginate($pagination);

        return $albums;
    }
}
