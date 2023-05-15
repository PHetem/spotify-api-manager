@extends('layouts.app')
@section('content')
<div style="text-align: center; vertical-align: middle; margin-top: 50px;">
    <div style="margin-top: 30px;">
        @if ($users->isEmpty())
            <span style="font-weight: bold; font-size: 2em;">No Users found</span>
            <p>Authorized users will show up here</p>
        @else
            <table class="table table-striped" style="width: 50%; display: inline-table; margin-bottom: 3rem;">
                <tr>
                    <td style="width:15%"><b>ID</b></td>
                    <td style="width:55%"><b>User</b></td>
                    <td style="width:15%"><b>Is Admin</b></td>
                    <td style="width:15%"><b>Action</b></td>
                </tr>
                @foreach ($users as $user)
                    <tr>
                        <td><b>{{ $user->id }}</b></td>
                        <td><a href="{{ route('users.details', $user->id) }}"><b>{{ $user->name }}</b><a></td>
                        <td><b>{{ $user->isAdmin ? 'Y' : 'N' }}</b></td>
                        <td>
                            <a href="{{ route('users.delete', $user->id) }}" onclick="return confirm('Are you sure?')" style="display: block; text-align: center;">
                                <img style="width:25px; height:25px; border:0" src="{{ asset('img/delete.ico') }}">
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
        @endif
    </div>
</div>
@endsection