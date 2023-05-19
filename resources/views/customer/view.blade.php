@extends('layouts.app')
@section('content')
<div style="margin-top: 100px;">
    <div class="container">
        <div class="row" style="height: 150px">
            <div class="col-10">
                <img style="width:-webkit-fill-available; margin-bottom:25px;" class="border rounded" src="{{ asset('img/mock_player.jpg') }}">
            </div>
            <div class="col-2">
                <a href="{{ route('customers.refresh', $customer->id) }}" style="display: block; text-align: center;">
                    <img style="width:75px; height:75px; margin-top: 50px; margin-bottom: 25px;" src="{{ asset('img/refresh.png') }}">
                </a>
            </div>
        </div>
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