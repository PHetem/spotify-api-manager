<?php

namespace App\Http\Controllers\Auth\APIAuth;

class CustomerAuthController extends APIAuthController
{
    protected static function getRequestType() {
        return 'REDIRECT';
    }

    protected static function getHeaders() {
        return ['Content-Type' => 'application/x-www-form-urlencoded'];
    }

    protected static function getURL() {
        return 'https://accounts.spotify.com/authorize?' . http_build_query(self::getData());
    }

    protected static function getData() {
        return ['client_id' => env('SPOTIFY_CLIENT_ID'), 'response_type' => 'code', 'redirect_uri' => env('SPOTIFY_REDIRECT_URI'), 'scope' => self::getScopes(), 'show_dialog' => true];
    }

    private static function getScopes() {
        return implode(' ', ['ugc-image-upload', 'user-read-playback-state', 'user-modify-playback-state',
        'user-read-currently-playing', 'app-remote-control', 'streaming',
        'playlist-read-private', 'playlist-read-collaborative', 'playlist-modify-private',
        'playlist-modify-public', 'user-follow-modify', 'user-follow-read',
        'user-read-playback-position', 'user-top-read', 'user-read-recently-played',
        'user-library-modify', 'user-library-read', 'user-read-email', 'user-read-private']);
    }
}
