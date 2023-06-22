@extends('layouts.app')
@section('content')
<div style="margin-top: 100px;">
    <div class="container">
        <div class="row" style="height: 330px">
            <div class="col-5">
                @include('user.details', ['title' => 'User Details', 'data' => $user])
            </div>
        </div>
    </div>
</div>
@endsection