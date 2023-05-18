<?php

namespace App\Http\Controllers\Media;

use App\Models\Media\Track;

class TrackController extends MediaController
{
    public static $model = Track::class;

    public static function requestMedia($ids) {
        return parent::requestMedia($ids);
    }

    public function list($pagination = 30) {
        $tracks = Track::paginate($pagination);

        return $tracks;
    }
}
