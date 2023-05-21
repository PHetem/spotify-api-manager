@extends('layouts.card')
@section('title'){{ $title }}@overwrite

@section('card_content')
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
@overwrite
