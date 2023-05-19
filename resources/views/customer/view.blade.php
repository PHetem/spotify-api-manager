@extends('layouts.app')
@section('content')
<div style="margin-top: 100px;">
    <div class="container">
        <div class="row" style="height: 330px">
            <div class="col-7">
                @include('customer.details', ['title' => 'Customer Details', 'data' => $customer])
            </div>
            <div class="col-5">
                @include('customer.card', ['title' => 'Playlists', 'data' => $customer->playlists])
            </div>
            <div class="col-4" style="margin-top: 80px">
                @include('customer.card', ['title' => 'Saved Artists', 'data' => $customer->artists])
            </div>
            <div class="col-4" style="margin-top: 80px">
                @include('customer.card', ['title' => 'Podcasts', 'data' => $customer->podcasts])
            </div>
            <div class="col-4" style="margin-top: 80px">
                @include('customer.card', ['title' => 'Saved Albums', 'data' => $customer->albums])
            </div>
            <div class="col-4" style="margin-top: 80px">
                @include('customer.card', ['title' => 'Saved Tracks', 'data' => $customer->tracks])
            </div>
        </div>
    </div>
</div>
@endsection