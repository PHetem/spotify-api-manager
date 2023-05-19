<?php

namespace App\Http\Controllers\APIAuth;

class UserAccessController extends APIAuthController
{
    protected static function getRequestType() {
        return 'POST';
    }
    protected static function getHeaders() {
        return ['Content-Type' => 'application/x-www-form-urlencoded'];
    }

    protected static function getURL() {
        return 'https://accounts.spotify.com/api/token';
    }

    protected static function getData() {
        return ['grant_type' => 'client_credentials', 'client_id' => env('SPOTIFY_CLIENT_ID'), 'client_secret' => env('SPOTIFY_CLIENT_SECRET')];
    }
}
