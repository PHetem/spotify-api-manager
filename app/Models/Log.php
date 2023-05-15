<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;

class Log extends Model
{
    use HasFactory;

    protected $fillable = [
        'action',
        'userID'
    ];

    public static function add($action) {
        self::create(['action' => $action, 'userID' => Auth::id()]);
    }

    public function user(): HasOne {
        return $this->hasOne(User::class, 'id', 'userID');
    }
}
