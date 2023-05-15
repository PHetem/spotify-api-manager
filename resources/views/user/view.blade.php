@extends('layouts.app')
@section('content')
<div style="text-align: center; vertical-align: middle; margin-top: 50px;">
    <div style="margin-top: 30px;">
        <div style="margin-top: 150px;">
            <div style="margin: auto; width: 50%;">
                <span style="font-weight: bold; font-size: 2em;">User Details</span>
            </div>
            <div style="width: 50%; margin: auto;">
                <div style="margin: 25px 40px; width: inherit; height: 300px; border: 1px solid; border-radius:10px; padding: 10px">
                    <div>
                        <span><b>ID:</b></span>
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