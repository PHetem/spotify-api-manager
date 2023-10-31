<?php

namespace App\Models\Playlist;

use App\Helpers\ImageHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    use HasFactory;

    public $name;
    public $owner;
    public $image;
    public $uri;

    public function __construct($playlist) {
        $this->name = $playlist['name'];
        $this->uri = $playlist['uri'];
        $this->owner = $playlist['owner']['display_name'];
        $this->image = ImageHelper::getImageBySize($playlist['images'], 'small');
    }
}
