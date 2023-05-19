<?php

namespace App\Http\Controllers\Media;

use App\Models\Media\Artist;

class ArtistController extends MediaController
{
    public static $model = Artist::class;

    public static function requestMedia($ids) {
        return parent::requestMedia($ids);
    }

    public static function requestCustomerMedia($id) {
        return parent::requestCustomerMedia($id);
    }

    public static function updateCustomerMedia($id) {
        $data = self::requestCustomerMedia($id)['artists']['items'];

        parent::updateMedia($id, $data);
    }

    protected static function mapResponse($id, $data) {
        $map['customerID'] = $id;
        $map['spotifyID'] = $data['id'];
        $map['name'] = $data['name'];
        $map['imageURL'] = $data['images'][0]['url'] ?? null;
        $map['URL'] = Artist::getBaseURL() . $data['id'];

        return $map;
    }
}
