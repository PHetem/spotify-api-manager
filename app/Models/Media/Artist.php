<?php

namespace App\Models\Media;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Artist extends Model
{
    use HasFactory;

    public function customer(): HasOne {
        return $this->hasOne(Customer::class, 'id', 'customerID');
    }

    public function albums(): HasMany {
        return $this->hasMany(Album::class, 'id', 'albumID');
    }

    public function tracks(): HasMany {
        return $this->hasMany(Track::class, 'id', 'trackID');
    }
}
