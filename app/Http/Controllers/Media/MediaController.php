<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\APITokenController;
use App\Http\Controllers\Controller;
use App\Models\Media\Artist;
use App\Models\Media\Playlist;
use App\Models\Media\TopArtist;
use App\Models\Media\TopTrack;
use Illuminate\Support\Facades\Http;

abstract class MediaController extends Controller
{
    public static $model;

    abstract protected static function mapResponse($id, $data);

    protected static function requestMedia($ids) {
        $token = APITokenController::getUserAccess()->token;
        $url = self::getUrl();

        $data = ['ids' => implode(',', $ids)];

        if (static::$model == Playlist::class)
            $url = $url . $ids[0];

        return Http::withToken($token)->get($url, $data)->json();
    }

    protected static function requestCustomerMedia($id) {
        $token = APITokenController::getCustomerAccess($id)->token;
        $url = self::getCustomerUrl();
        $data = [];

        switch (static::$model) {
            case Artist::class:
                $data['type'] = 'artist';
                break;

            case TopArtist::class:
            case TopTrack::class:
                $data['limit'] = 10;
                break;
        }

        return Http::withToken($token)->get($url, $data)->json();
    }

    protected static function updateMedia($id, $data) {
        $model = static::$model;

        $model::where('customerID', $id)->delete();

        $counter = 1;

        foreach ($data as $item) {
            $item['counter'] = $counter;

            $map = static::mapResponse($id, $item);
            $model::updateOrCreate(['spotifyID' => $map['spotifyID']], $map);

            $counter++;
        }
    }

    private static function getUrl() {
        $model = static::$model;
        return $model::getBaseRequestURL();
    }

    private static function getCustomerUrl() {
        $model = static::$model;
        return $model::getCustomerRequestURL();
    }
}
