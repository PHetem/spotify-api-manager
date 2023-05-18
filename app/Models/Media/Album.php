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
        'customerID',
        'name',
        'URL',
        'coverImageURL'
    ];

    public static function getBaseRequestURL() {
        return 'https://api.spotify.com/v1/albums/';
    }

    public function customer(): HasOne {
        return $this->hasOne(Customer::class, 'id', 'customerID');
    }

    public function tracks(): HasMany {
        return $this->hasMany(Track::class, 'id', 'trackID');
    }

    public function artist(): HasOne {
        return $this->hasOne(Artist::class, 'id', 'artistID');
    }
}
