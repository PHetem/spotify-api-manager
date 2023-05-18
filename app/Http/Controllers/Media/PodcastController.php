<?php

namespace App\Http\Controllers\Media;

use App\Models\Media\Podcast;

class PodcastController extends MediaController
{
    public static $model = Podcast::class;

    public static function requestMedia($ids) {
        return parent::requestMedia($ids);
    }

    public function list($pagination = 30) {
        $podcasts = Podcast::paginate($pagination);

        return $podcasts;
    }
}
