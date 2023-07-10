<?php

namespace App\Models\Media;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopArtist extends Top
{
    use HasFactory;

    public static $type = 'artist';
}
