<?php

namespace App\Http\Controllers\PlaylistTools;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlaylistToolsController extends Controller
{
    public function listTools(Request $request) {
        return view('playlistTools.index');
    }
}
