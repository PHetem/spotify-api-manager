<?php

namespace App\Http\Controllers\Auth\APIAuth;

use InvalidArgumentException;

class CustomerAccessController extends APIAuthController
{
    protected static function getRequestType() {
        return 'POST';
    }

    protected static function getHeaders() {
        return ['Authorization' => self::getAuth(), 'Content-Type' => 'application/x-www-form-urlencoded'];
    }

    protected static function getURL() {
        return 'https://accounts.spotify.com/api/token';
    }

    protected static function getData($externalData = null) {
        if (!isset($externalData['code']))
            throw new InvalidArgumentException('code not provided');

        return ['grant_type' => 'authorization_code', 'code' => $externalData['code'], 'redirect_uri' => env('SPOTIFY_REDIRECT_URI')];
    }

    private static function getAuth() {
        return 'Basic ' . base64_encode(env('SPOTIFY_CLIENT_ID') . ':' . env('SPOTIFY_CLIENT_SECRET'));
    }
}
