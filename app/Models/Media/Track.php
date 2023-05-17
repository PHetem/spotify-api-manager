<?php

namespace App\Models\Media;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Track extends Model
{
    use HasFactory;

    protected $fillable = [
        'customerID',
        'name',
        'URL',
        'albumID'
    ];

    public function customer(): HasOne {
        return $this->hasOne(Customer::class, 'id', 'customerID');
    }

    public function album(): HasOne {
        return $this->hasOne(Album::class, 'id', 'albumID');
    }

    public function artist(): HasOne {
        return $this->hasOne(Artist::class, 'id', 'artistID');
    }
}
