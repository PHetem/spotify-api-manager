<?php

namespace App\Http\Controllers\Music;

use App\Models\Customer\Track;
use App\Http\Controllers\Controller;

class TrackController extends Controller
{
    public function list($pagination = 30) {
        $tracks = Track::paginate($pagination);

        return $tracks;
    }
}
