<?php

namespace App\Http\Controllers\APIAuth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

abstract class APIAuthController extends Controller
{
    abstract protected static function getHeaders();
    abstract protected static function getData();
    abstract protected static function getURL();
    abstract protected static function getRequestType();

    public static function getToken() {
        $headers = static::getHeaders();
        $data = static::getData();
        $url = static::getURL();

        if (static::getRequestType() == 'POST') {
            return Http::withHeaders($headers)->asForm()->post($url, $data)->json();
        } else {
            return Http::withHeaders($headers)->get($url, $data)->json();
        }
    }
}
