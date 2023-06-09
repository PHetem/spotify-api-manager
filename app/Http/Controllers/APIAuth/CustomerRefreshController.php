<?php

namespace App\Http\Controllers\APIAuth;

use InvalidArgumentException;

class CustomerRefreshController extends APIAuthController
{
    protected static function getRequestType() {
        return 'POST';
    }

    protected static function getHeaders() {
        return ['Authorization' => self::getAuth(), 'Content-Type' => 'application/x-www-form-urlencoded'];
    }

    protected static function getURL() {
        return config('constants.spotify_auth_base_url') . 'api/token';
    }

    protected static function getData($externalData = null) {
        if (!isset($externalData['refreshToken']))
            throw new InvalidArgumentException('Refresh Token not provided');

        return ['grant_type' => 'refresh_token', 'refresh_token' => $externalData['refreshToken']['token']];
    }

    private static function getAuth() {
        return 'Basic ' . base64_encode(env('SPOTIFY_CLIENT_ID') . ':' . env('SPOTIFY_CLIENT_SECRET'));
    }
}
