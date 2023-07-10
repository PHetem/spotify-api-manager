<?php

namespace App\Http\Controllers\Media;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\Media\TopTrack;
use Illuminate\Http\Request;

class TopTrackController extends MediaController
{
    public static $model = TopTrack::class;

    public static function requestMedia($ids) {
        return parent::requestMedia($ids);
    }

    public static function requestCustomerMedia($id) {
        return ['topTracks' => [parent::requestCustomerMedia($id)][0]];
    }

    public function list($pagination = 30) {
        $tracks = TopTrack::paginate($pagination);

        return $tracks;
    }

    public static function updateCustomerMedia($id) {
        $data = self::requestCustomerMedia($id)['topTracks']['items'];

        parent::updateMedia($id, $data);
    }

    protected static function mapResponse($id, $data) {
        $map['customerID'] = $id;
        $map['spotifyID'] = $data['id'];
        $map['name'] = $data['name'];
        $map['imageURL'] = ImageHelper::getImageBySize($data['album']['images'], 'small');
        $map['URL'] = TopTrack::getBaseURL() . $data['id'];
        $map['rank'] = $data['counter'];
        $map['artist'] = $data['artists'][0]['name'];

        return $map;
    }
}
