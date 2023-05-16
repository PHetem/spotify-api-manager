<?php

namespace App\Http\Controllers;

use App\Models\Podcast;
use Illuminate\Http\Request;

class PodcastController extends Controller
{
    public function list($pagination = 30) {
        $podcasts = Podcast::paginate($pagination);

        return $podcasts;
    }
}
