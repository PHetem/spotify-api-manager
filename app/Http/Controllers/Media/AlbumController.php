<?php

namespace App\Http\Controllers\Media;

use App\Helpers\ImageHelper;
use App\Models\Media\Album;

class AlbumController extends MediaController
{
    public static $model = Album::class;

    public static function requestMedia($ids) {
        return parent::requestMedia($ids);
    }

    public static function requestCustomerMedia($id) {
        return ['albums' => [parent::requestCustomerMedia($id)][0]];
    }

    public function list($pagination = 30) {
        $albums = Album::paginate($pagination);

        return $albums;
    }

    public static function updateCustomerMedia($id) {
        $data = self::requestCustomerMedia($id)['albums']['items'];

        parent::updateMedia($id, $data);
    }

    protected static function mapResponse($id, $data) {
        $data = $data['album'];

        $map['customerID'] = $id;
        $map['spotifyID'] = $data['id'];
        $map['name'] = $data['name'];
        $map['imageURL'] = ImageHelper::getImageBySize($data['images'], 'medium');
        $map['URL'] = Album::getBaseURL() . $data['id'];

        return $map;
    }
}
