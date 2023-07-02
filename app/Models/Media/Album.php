<?php

namespace App\Models\Media;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Album extends Model
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
        return 'https://open.spotify.com/album/';
    }

    public static function getBaseRequestURL() {
        return 'https://api.spotify.com/v1/albums/';
    }

    public static function getCustomerRequestURL() {
        return config('constants.spotify_base_url') . 'albums/';
    }

    public function customer(): HasOne {
        return $this->hasOne(Customer::class, 'id', 'customerID');
    }
}
