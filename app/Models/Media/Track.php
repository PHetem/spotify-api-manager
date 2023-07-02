<?php

namespace App\Models\Media;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Track extends Model
{
    use HasFactory;

    protected $fillable = [
        'spotifyID',
        'customerID',
        'name',
        'URL',
        'imageURL'
    ];

    public static function getBaseURL() {
        return 'https://open.spotify.com/track/';
    }

    public static function getBaseRequestURL() {
        return 'https://api.spotify.com/v1/tracks/';
    }

    public static function getCustomerRequestURL() {
        return config('constants.spotify_base_url') . 'me/tracks/';
    }

    public function customer(): HasOne {
        return $this->hasOne(Customer::class, 'id', 'customerID');
    }
}
