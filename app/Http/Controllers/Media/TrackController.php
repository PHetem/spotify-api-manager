<?php

namespace App\Http\Controllers\Media;

use App\Helpers\ImageHelper;
use App\Models\Media\Track;

class TrackController extends MediaController
{
    public static $model = Track::class;

    public static function requestMedia($ids) {
        return parent::requestMedia($ids);
    }

    public static function requestCustomerMedia($id) {
        return ['tracks' => [parent::requestCustomerMedia($id)][0]];
    }

    public function list($pagination = 30) {
        $tracks = Track::paginate($pagination);

        return $tracks;
    }

    public static function updateCustomerMedia($id) {
        $data = self::requestCustomerMedia($id)['tracks']['items'];

        parent::updateMedia($id, $data);
    }

    protected static function mapResponse($id, $data) {
        $data = $data['track'];

        $map['customerID'] = $id;
        $map['spotifyID'] = $data['id'];
        $map['name'] = $data['name'];
        $map['imageURL'] = ImageHelper::getImageBySize($data['album']['images'], 'medium');
        $map['URL'] = Track::getBaseURL() . $data['id'];

        return $map;
    }
}
