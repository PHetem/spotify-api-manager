<?php

namespace App\Models\Media;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Podcast extends Model
{
    use HasFactory;

    protected $fillable = [
        'customerID',
        'name',
        'URL',
        'coverImageURL'
    ];

    public static function getBaseRequestURL() {
        return 'https://api.spotify.com/v1/shows/';
    }

    public function customer(): HasOne {
        return $this->hasOne(Customer::class, 'id', 'customerID');
    }
}
