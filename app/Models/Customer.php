<?php

namespace App\Models;

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
}
