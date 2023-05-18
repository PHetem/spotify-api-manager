<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class APIToken extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'token',
        'customerID',
        'userID',
        'expiresAt',
    ];

    public static function get($id, $userType, $tokenType) {
        return self::where(['type' => $tokenType])
                ->when($userType == 'User', function(Builder $query) use ($id) {
                    return $query->where('userID', $id);
                })
                ->when($userType == 'Customer', function(Builder $query) use ($id) {
                    return $query->where('customerID', $id);
                })->first();
    }
}
