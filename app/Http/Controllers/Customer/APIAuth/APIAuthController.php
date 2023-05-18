<?php

namespace App\Http\Controllers\Customer\APIAuth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class APIAuthController extends Controller
{
    public static function getNewUserAccessToken() {
        $headers = ['Content-Type: application/x-www-form-urlencoded'];
        $body = ['grant_type' => 'client_credentials', 'client_id' => env('SPOTIFY_CLIENT_ID'), 'client_secret' => env('SPOTIFY_CLIENT_SECRET')];
        return Http::withHeaders($headers)->asForm()->post('https://accounts.spotify.com/api/token', $body)->json();
    }
}
