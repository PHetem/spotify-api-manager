<?php

namespace App\Http\Controllers\Media;

use App\Models\Media\Artist;

class ArtistController extends MediaController
{
    public static $model = Artist::class;

    public static function requestMedia($ids) {
        return parent::requestMedia($ids);
    }
}
