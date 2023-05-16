<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function list($pagination = 30) {
        $albums = Album::paginate($pagination);

        return $albums;
    }
}
