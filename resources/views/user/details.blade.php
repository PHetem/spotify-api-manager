@extends('layouts.cardsmall')

@section('title'){{ $title }}@overwrite

@section('card_content')
    <div class="col-7">
        <div>
            <span><b>User ID:</b></span>
            <span>{{ $user->id }}</span>
        </div>
        <div class="content-line">
            <span><b>Name:</b></span>
            <span>{{ $user->name }}</span>
        </div>
        <div class="content-line">
            <span><b>Email:</b></span>
            <span>{{ $user->email }}</span>
        </div>
        <div class="content-line">
            <span><b>Is Admin:</b></span>
            <span>{{ $user->isAdmin ? 'Yes' : 'No' }}</span>
        </div>
    </div>
    <div class="col-5 button-bottom">
        <div style="text-align: right;">
            <a class="btn btn-success" href="{{ route('users.edit', $user->id) }}">Edit</a>
        </div>
        @if (!Auth::user()->isAdmin || Auth::user()->id == $user->id)
            <div class="mt-2"style="text-align: right;">
                <a class="btn btn-success" href="{{ route('users.pass.edit', $user->id) }}">Update Password</a>
            </div>
        @endif
    </div>
@overwrite
