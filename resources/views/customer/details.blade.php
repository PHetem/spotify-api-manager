
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
            <span>{{ $data->accessToken->token }}</span>
        </div>
        <div class="content-line">
            <span><b>Refresh Token:</b></span>
            <span>{{ $data->refreshToken->token }}</span>
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
@overwrite
