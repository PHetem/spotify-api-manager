@extends('layouts.app')
@section('content')
<div style="margin-top: 100px;">
    <div class="container">
        <div style="height: 150px; margin-bottom:30px;">
            @include('player.index', ['customerID' => $customer->id])
        </div>
        <div class="row" style="height: 330px">
            <div class="col-7">
                @include('customer.details', ['title' => 'Customer Details', 'data' => $customer])
            </div>
            <div class="col-5">
                @include('customer.cardBlock', ['title' => 'Playlists', 'header' => ['type' => 'button', 'text' => 'Create New Playlist', 'href' => 'playlists.create'], 'data' => $customer->playlists])
            </div>
            <div class="col-4" style="margin-top: 80px">
                @include('customer.cardBlock', ['title' => 'Saved Artists', 'data' => $customer->artists])
            </div>
            <div class="col-4" style="margin-top: 80px">
                @include('customer.cardBlock', ['title' => 'Podcasts', 'data' => $customer->podcasts])
            </div>
            <div class="col-4" style="margin-top: 80px">
                @include('customer.cardBlock', ['title' => 'Saved Albums', 'data' => $customer->albums])
            </div>
            <div class="col-4" style="margin-top: 80px">
                @include('customer.cardBlock', ['title' => 'Saved Tracks', 'data' => $customer->tracks])
            </div>
            <div class="col-4" style="margin-top: 80px">
                @include('customer.cardList', ['title' => 'Top Tracks', 'data' => $customer->topTracks])
            </div>
            <div class="col-4" style="margin-top: 80px">
                @include('customer.cardList', ['title' => 'Top Artists', 'data' => $customer->topArtists])
            </div>
        </div>
    </div>
</div>
@endsection