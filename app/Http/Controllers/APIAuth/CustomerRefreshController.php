<?php

namespace App\Http\Controllers\APIAuth;

class CustomerRefreshController extends APIAuthController
{
    protected static function getRequestType() {
        return 'POST';
    }

    protected static function getHeaders() {
        return ['Authorization' => self::getAuth(), 'Content-Type' => 'application/x-www-form-urlencoded'];
    }

    protected static function getURL() {
        return 'https://accounts.spotify.com/api/refresh_token';
    }

    protected static function getData($externalData = null) {
        return ['grant_type' => 'refresh_token', 'refresh_token' => 'TODO'];
    }

    private static function getAuth() {
        return 'Basic ' . base64_encode(env('SPOTIFY_CLIENT_ID') . ':' . env('SPOTIFY_CLIENT_SECRET'));
    }
}
