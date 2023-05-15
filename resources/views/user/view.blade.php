@extends('layouts.app')
@section('content')
<div style="margin-top: 100px;">
    <div class="container">
        <div class="row" style="height: 330px">
            <span class="cardTitle">User Details</span>
            <div class="card h-100 w-25" style="overflow: auto">
                <div class="card-body">
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection