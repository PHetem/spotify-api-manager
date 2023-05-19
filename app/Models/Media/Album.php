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
        'coverImageURL'
    ];

    public static function getBaseURL() {
        return 'https://open.spotify.com/album/';
    }

    public static function getBaseRequestURL() {
        return 'https://api.spotify.com/v1/albums/';
    }

    public static function getCustomerRequestURL() {
        return 'https://api.spotify.com/v1/me/albums/';
    }

    public function customer(): HasOne {
        return $this->hasOne(Customer::class, 'id', 'customerID');
    }
}
