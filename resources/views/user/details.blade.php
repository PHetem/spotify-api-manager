@extends('layouts.card')
@section('title'){{ $title }}@overwrite

@section('card_content')
    <div>
        <span><b>User ID:</b></span>
        <span>{{ $user->id }}</span>
    </div>
    <div style="margin-top: 15px;">
        <span><b>Name:</b></span>
        <span>{{ $user->name }}</span>
    </div>
    <div style="margin-top: 15px;">
        <span><b>Email:</b></span>
        <span>{{ $user->email }}</span>
    </div>
    <div style="margin-top: 15px;">
        <span><b>Is Admin:</b></span>
        <span>{{ $user->isAdmin ? 'Yes' : 'No' }}</span>
    </div>
@overwrite
