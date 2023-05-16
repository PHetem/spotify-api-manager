<?php

namespace App\Models\Customer;

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

    public function customer(): HasOne {
        return $this->hasOne(Customer::class, 'id', 'customerID');
    }

    public function tracks(): HasMany {
        return $this->hasMany(Track::class, 'id', 'trackID');
    }
}