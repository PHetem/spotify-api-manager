<?php

namespace App\Http\Controllers;

use App\Models\Track;
use Illuminate\Http\Request;

class TrackController extends Controller
{
    public function list($pagination = 30) {
        $tracks = Track::paginate($pagination);

        return $tracks;
    }
}
