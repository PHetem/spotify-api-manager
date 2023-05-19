<?php

namespace App\Models\Customer;

use App\Models\APIToken;
use App\Models\Media\Album;
use App\Models\Media\Artist;
use App\Models\Media\Playlist;
use App\Models\Media\Podcast;
use App\Models\Media\Track;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Http;

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
        'accountType'
    ];

    public static function requestCustomerData($accessToken) {
        return Http::withToken($accessToken)->get(self::getBaseRequestURL())->json();
    }

    public static function getBaseRequestURL() {
        return 'https://api.spotify.com/v1/me/';
    }

    public function refreshToken(): HasOne {
        return $this->hasOne(APIToken::class, 'customerID', 'id')->where('a_p_i_tokens.type', 'Refresh');
    }

    public function accessToken(): HasOne {
        return $this->hasOne(APIToken::class, 'customerID', 'id')->where('a_p_i_tokens.type', 'Access');
    }

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

    public function artists(): HasMany {
        return $this->hasMany(Artist::class, 'customerID', 'id');
    }
}
