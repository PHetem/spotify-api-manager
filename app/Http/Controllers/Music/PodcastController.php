<?php

namespace App\Http\Controllers\Music;

use App\Http\Controllers\Controller;
use App\Models\Customer\Podcast;

class PodcastController extends Controller
{
    public function list($pagination = 30) {
        $podcasts = Podcast::paginate($pagination);

        return $podcasts;
    }
}
