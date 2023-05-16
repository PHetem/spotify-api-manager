@extends('layouts.app')
@section('content')
<div style="margin-top: 100px;">
    <div class="container">
        <div class="row" style="height: 330px">
            <div class="col-7">
                @include('customer.details')
            </div>
            <div class="col-5">
                @include('customer.playlists.list')
            </div>
            <div class="col-4" style="margin-top: 80px">
                @include('customer.podcasts.list')
            </div>
            <div class="col-4" style="margin-top: 80px">
                @include('customer.albums.list')
            </div>
            <div class="col-4" style="margin-top: 80px">
                @include('customer.tracks.list')
            </div>
        </div>
    </div>
</div>
@endsection