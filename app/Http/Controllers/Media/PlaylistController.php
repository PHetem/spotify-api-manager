<?php

namespace App\Http\Controllers\Media;

use App\Models\Media\Playlist;
use InvalidArgumentException;

class PlaylistController extends MediaController
{
    public static $model = Playlist::class;

    public static function requestMedia($ids) {
        if (count($ids) > 1)
            throw new InvalidArgumentException('Playlists do not allow multiple ID search');

        return ['playlists' => [parent::requestMedia($ids)]];
    }

    public static function requestCustomerMedia($id) {
        return ['playlists' => [parent::requestCustomerMedia($id)][0]];
    }

    public function list($pagination = 30) {
        $playlists = Playlist::paginate($pagination);

        return $playlists;
    }

    public static function updateCustomerMedia($id) {
        $data = self::requestCustomerMedia($id)['playlists']['items'];

        parent::updateMedia($id, $data);
    }

    protected static function mapResponse($id, $data) {
        $map['customerID'] = $id;
        $map['spotifyID'] = $data['id'];
        $map['name'] = $data['name'];
        $map['imageURL'] = $data['images'][0]['url'] ?? null;
        $map['URL'] = Playlist::getBaseURL() . $data['id'];

        return $map;
    }
}
