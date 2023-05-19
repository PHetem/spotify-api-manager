<?php

namespace App\Models\Media;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Artist extends Model
{
    use HasFactory;

    protected $fillable = [
        'spotifyID',
        'customerID',
        'name',
        'profileURL',
        'profilePictureURL'
    ];

    public static function getBaseURL() {
        return 'https://open.spotify.com/artist/';
    }

    public static function getBaseRequestURL() {
        return 'https://api.spotify.com/v1/artists/';
    }

    public static function getCustomerRequestURL() {
        return 'https://api.spotify.com/v1/me/following/';
    }

    public function customer(): HasOne {
        return $this->hasOne(Customer::class, 'id', 'customerID');
    }
}
