
@extends('customer.card_template')

@section('title'){{ $title }}@overwrite

@section('card_content')
    <div class="col-8">
        <div>
            <span><b>User ID:</b></span>
            <span>{{ $data->id }}</span>
        </div>
        <div style="margin-top: 15px;">
            <span><b>Spotify ID:</b></span>
            <span>{{ $data->spotifyID }}</span>
        </div>
        <div style="margin-top: 15px;">
            <span><b>Name:</b></span>
            <span>{{ $data->name }}</span>
        </div>
        <div style="margin-top: 15px;">
            <span><b>Email:</b></span>
            <span>{{ $data->email }}</span>
        </div>
        <div style="margin-top: 15px;">
            <span><b>Country:</b></span>
            <span>{{ $data->country }}</span>
        </div>
        <div style="margin-top: 15px;">
            <span><b>Profile:</b></span>
            <a href="{{ $data->profileURL }}" target="_blank">Click here</a>
        </div>
        <div style="margin-top: 15px;">
            <span><b>Access Token:</b></span>
            <span>{{ $data->accessToken->token }}</span>
        </div>
        <div style="margin-top: 15px;">
            <span><b>Refresh Token:</b></span>
            <span>{{ $data->refreshToken->token }}</span>
        </div>
    </div>
    <div class="col-4">
        <div>
            <img width="200" class="border rounded" src="{{ asset($data->profilePictureURL) }}">
        </div>
        <div style="margin-top: 15px;">
            <span><b>{{ $data->followerCount }} Followers</b></span>
        </div>
        <div style="margin-top: 15px;">
            <span><b>{{ $data->accountType }} User</b></span>
        </div>
    </div>
@overwrite
