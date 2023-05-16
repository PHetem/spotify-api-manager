<?php

namespace App\Http\Controllers\Customer;

use App\Models\Customer\Album;
use App\Http\Controllers\Controller;

class AlbumController extends Controller
{
    public function list($pagination = 30) {
        $albums = Album::paginate($pagination);

        return $albums;
    }
}
