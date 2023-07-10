<?php

namespace App\Http\Controllers\Media;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\Media\TopArtist;
use Illuminate\Http\Request;

class TopArtistController extends MediaController
{
    public static $model = TopArtist::class;

    public static function requestMedia($ids) {
        return parent::requestMedia($ids);
    }

    public static function requestCustomerMedia($id) {
        return ['topArtists' => [parent::requestCustomerMedia($id)][0]];
    }

    public function list($pagination = 30) {
        $tracks = TopArtist::paginate($pagination);

        return $tracks;
    }

    public static function updateCustomerMedia($id) {
        $data = self::requestCustomerMedia($id)['topArtists']['items'];

        parent::updateMedia($id, $data);
    }

    protected static function mapResponse($id, $data) {
        $map['customerID'] = $id;
        $map['spotifyID'] = $data['id'];
        $map['name'] = $data['name'];
        $map['imageURL'] = ImageHelper::getImageBySize($data['images'], 'small');
        $map['URL'] = TopArtist::getBaseURL() . $data['id'];
        $map['rank'] = $data['counter'];

        return $map;
    }
}
