@extends('layouts.app')
@section('content')
<div class="table-pos">
    <div style="margin-top: 100px;">
        <div>
            <a class="btn btn-success" style="margin:40px;" href="{{ route('register') }}">Add New</a>
        </div>
        @if ($users->isEmpty())
            <span class="main-title">No Users found</span>
            <p><span class="sub-title">Authorized users will show up here</span></p>
        @else
            <div class="table-title">
                <span class="main-title">Users</span>
            </div>
            <table class="table table-striped table-half table-rounded">
                <tr>
                    <td style="width:15%"><b>ID</b></td>
                    <td style="width:55%"><b>User</b></td>
                    <td style="width:15%"><b>Is Admin</b></td>
                    <td style="width:15%"><b>Action</b></td>
                </tr>
                @foreach ($users as $user)
                    <tr>
                        <td><b>{{ $user->id }}</b></td>
                        <td>
                            <a href="{{ route('users.details', $user->id) }}"><b>{{ $user->name }}</b></a>
                        </td>
                        <td><b>{{ $user->isAdmin ? 'Y' : 'N' }}</b></td>
                        <td>
                            <a href="{{ route('users.delete', $user->id) }}" onclick="return confirm('Are you sure?')" style="display: block; text-align: center;">
                                <img class="icon" src="{{ asset('img/delete.ico') }}">
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
            <div>
                {{ $users->links() }}
            </div>
        @endif
    </div>
</div>
@endsection