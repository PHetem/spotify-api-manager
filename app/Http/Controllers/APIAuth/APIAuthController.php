<?php

namespace App\Http\Controllers\APIAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

abstract class APIAuthController extends Controller
{
    abstract protected static function getHeaders();
    abstract protected static function getData();
    abstract protected static function getURL();
    abstract protected static function getRequestType();

    public static function getToken($externalData = null) {
        $headers = static::getHeaders();
        $data = static::getData($externalData);
        $url = static::getURL();

        if (static::getRequestType() == 'POST') {
            return Http::withHeaders($headers)->asForm()->post($url, $data)->json();
        } elseif (static::getRequestType() == 'REDIRECT') {
            return redirect($url, 302, $headers)->send();
        } else {
            return Http::withHeaders($headers)->withUrlParameters($data)->get($url);
        }
    }
}
