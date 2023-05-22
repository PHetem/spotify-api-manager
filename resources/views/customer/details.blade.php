
@extends('layouts.card')

@section('title'){{ $title }}@overwrite

@section('card_content')
    <div class="col-8">
        <div>
            <span><b>User ID:</b></span>
            <span>{{ $data->id }}</span>
        </div>
        <div class="content-line">
            <span><b>Spotify ID:</b></span>
            <span>{{ $data->spotifyID }}</span>
        </div>
        <div class="content-line">
            <span><b>Name:</b></span>
            <span>{{ $data->name }}</span>
        </div>
        <div class="content-line">
            <span><b>Email:</b></span>
            <span>{{ $data->email }}</span>
        </div>
        <div class="content-line">
            <span><b>Country:</b></span>
            <span>{{ $data->country }}</span>
        </div>
        <div class="content-line">
            <span><b>Profile:</b></span>
            <a href="{{ $data->profileURL }}" target="_blank">Click here</a>
        </div>
        <div class="content-line">
            <span><b>Access Token:</b></span>
            <button class="btn btn-success" onclick="copyToClipboard('{{ $data->accessToken->token }}')">Copy access token to clipboard</button>
        </div>
        <div class="content-line">
            <span><b>Refresh Token:</b></span>
            <button class="btn btn-success" onclick="copyToClipboard('{{ $data->refreshToken->token }}')">Copy refresh token to clipboard</button>
        </div>
    </div>
    <div class="col-4">
        <div>
            <img width="200" class="border rounded" src="{{ asset($data->profilePictureURL) }}">
        </div>
        <div class="content-line">
            <span><b>{{ $data->followerCount }} Followers</b></span>
        </div>
        <div class="content-line">
            <span><b>{{ $data->accountType }} User</b></span>
        </div>
    </div>
    <script>
        const copyToClipboard = str => {
            if (navigator && navigator.clipboard && navigator.clipboard.writeText)
                return navigator.clipboard.writeText(str);
            return Promise.reject('The Clipboard API is not available.');
        };
    </script>
@overwrite
