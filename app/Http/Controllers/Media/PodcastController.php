<?php

namespace App\Http\Controllers\Media;

use App\Helpers\ImageHelper;
use App\Models\Media\Podcast;

class PodcastController extends MediaController
{
    public static $model = Podcast::class;

    public static function requestMedia($ids) {
        return parent::requestMedia($ids);
    }

    public static function requestCustomerMedia($id) {
        return ['shows' => [parent::requestCustomerMedia($id)][0]];
    }

    public function list($pagination = 30) {
        $podcasts = Podcast::paginate($pagination);

        return $podcasts;
    }

    public static function updateCustomerMedia($id) {
        $data = self::requestCustomerMedia($id)['shows']['items'];

        parent::updateMedia($id, $data);
    }

    protected static function mapResponse($id, $data) {
        $data = $data['show'];

        $map['customerID'] = $id;
        $map['spotifyID'] = $data['id'];
        $map['name'] = $data['name'];
        $map['imageURL'] = ImageHelper::getImageBySize($data['images'], 'medium');
        $map['URL'] = Podcast::getBaseURL() . $data['id'];

        return $map;
    }
}
