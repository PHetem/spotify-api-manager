@extends('layouts.app')
@section('content')
<div style="text-align: center; vertical-align: middle; margin-top: 50px;">
    <div style="margin-top: 100px;">
        @if ($logs->isEmpty())
            <span style="font-weight: bold; font-size: 2em;">No logs avaiable</span>
            <p>Logs generaated by the users will show up here</p>
        @else
            <div style="margin-bottom: 25px;">
                <span style="font-weight: bold; font-size: 2em;">Logs</span>
            </div>
            <table class="table table-striped" style="width: 50%; display: inline-table; margin-bottom: 3rem;">
                <tr>
                    <td style="width:10%"><b>Id</b></td>
                    <td style="width:40%"><b>Action</b></td>
                    <td style="width:30%"><b>Date</b></td>
                    <td style="width:20%"><b>User</b></td>
                </tr>
                @foreach ($logs as $log)
                    <tr>
                        <td><b>{{ $log->id }}</b></td>
                        <td>{{ $log->action }}</td>
                        <td>{{ $log->created_at }}</td>
                        <td><a href="{{ route('logs.list', $log->user->id) }}"><b>{{ $log->user->name }}</b><a></td>
                    </tr>
                @endforeach
            </table>
            <div>
                {{ $logs->links() }}
            </div>
        @endif
    </div>
</div>
@endsection