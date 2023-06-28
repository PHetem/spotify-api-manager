@extends('layouts.app')
@section('content')
<div class="table-pos">
    <div style="margin-top: 100px;">
        @if ($logs->isEmpty())
            <span class="main-title">No logs avaiable</span>
            <p><span class="sub-title">Logs generaated by the users will show up here</span></p>
        @else
            <div class="table-title">
                <span class="main-title">Logs</span>
            </div>
            <table class="table table-striped table-half table-rounded">
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