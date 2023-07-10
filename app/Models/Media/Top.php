<?php

namespace App\Models\Media;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Top extends Model
{
    use HasFactory;

    public static $type;

    protected $fillable = [
        'spotifyID',
        'customerID',
        'name',
        'URL',
        'imageURL',
        'rank',
        'artist'
    ];

    public static function getBaseURL() {
        return 'https://open.spotify.com/' . static::$type . '/';
    }

    public static function getBaseRequestURL() {
        return 'https://api.spotify.com/v1/' . static::$type . 's';
    }

    public static function getCustomerRequestURL() {
        return config('constants.spotify_base_url') . 'me/top/' . static::$type . 's?limit=10';
    }

    public function customer(): HasOne {
        return $this->hasOne(Customer::class, 'id', 'customerID');
    }
}

