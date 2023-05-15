@extends('layouts.app')
@section('content')
<div style="margin-top: 100px;">
    <div class="container">
        <div class="row" style="height: 330px">
            <div class="col-7">
                @include('customer.cards.details')
            </div>
            <div class="col-5">
                @include('customer.cards.playlists')
            </div>
        </div>
    </div>
</div>
@endsection