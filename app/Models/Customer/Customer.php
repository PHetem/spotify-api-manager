<?php

namespace App\Models\Customer;

use App\Models\Music\Album;
use App\Models\Music\Playlist;
use App\Models\Music\Podcast;
use App\Models\Music\Track;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'spotifyID',
        'name',
        'email',
        'country',
        'followerCount',
        'profileURL',
        'profilePictureURL',
        'accountType',
        'accessToken',
        'refreshToken',
    ];

    public function playlists(): HasMany {
        return $this->hasMany(Playlist::class, 'customerID', 'id');
    }

    public function albums(): HasMany {
        return $this->hasMany(Album::class, 'customerID', 'id');
    }

    public function tracks(): HasMany {
        return $this->hasMany(Track::class, 'customerID', 'id');
    }

    public function podcasts(): HasMany {
        return $this->hasMany(Podcast::class, 'customerID', 'id');
    }
}
