<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\APITokenController;
use App\Http\Controllers\Controller;
use App\Models\Media\Playlist;
use Illuminate\Support\Facades\Http;

class MediaController extends Controller
{
    public static $model;

    protected static function requestMedia($ids) {
        $token = APITokenController::getUserAccess()->token;
        $url = self::getUrl();

        $data = ['ids' => implode(',', $ids)];

        if (static::$model == Playlist::class)
            $url = $url . $ids[0];

        return Http::withToken($token)->get($url, $data)->json();
    }

    private static function getUrl() {
        $model = static::$model;
        return $model::getBaseRequestURL();
    }
}
