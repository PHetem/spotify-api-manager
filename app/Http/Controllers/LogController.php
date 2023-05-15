<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Database\Eloquent\Builder;

class LogController extends Controller
{

    public static function store($action) {
        Log::add($action);
    }

    public function list($userID = null, $pagination = 30) {
        LogController::store('View logs');

        $logs = Log::with('user')
                    ->when(!is_null($userID), function(Builder $query) use ($userID) {
                        return $query->where('userID', $userID);
                    })->orderBy('id', 'desc')
                    ->paginate($pagination);

        return view('logs.view', compact('logs'));
    }
}
