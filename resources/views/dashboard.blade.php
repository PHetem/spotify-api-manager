@extends('layouts.app')
@section('content')
<div style="text-align: center; vertical-align: middle; margin-top: 50px;">
    <div style="margin-top: 100px;">
        @if ($customers->isEmpty())
            <span style="font-weight: bold; font-size: 2em;">No Customers found</span>
            <p>Authorized users will show up here</p>
        @else
            <div style="margin-bottom: 25px;">
                <span style="font-weight: bold; font-size: 2em;">Customers</span>
            </div>
            <table class="table table-striped" style="width: 50%; display: inline-table; margin-bottom: 3rem;">
                <tr>
                    <td style="width:85%"><b>Name</b></td>
                    <td style="width:15%"><b>Remove</b></td>
                </tr>
                @foreach ($customers as $customer)
                    <tr>
                        <td><a href="{{ route('customers.details', $customer->id) }}"><b>{{ $customer->name }}</b><a></td>
                        <td>
                            <a href="{{ route('customers.delete', $customer->id) }}" onclick="return confirm('Are you sure?')" style="display: block; text-align: center;">
                                <img style="width:25px; height:25px; border:0" src="{{ asset('img/delete.ico') }}">
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
            <div>
                {{ $customers->links() }}
            </div>
        @endif
    </div>
</div>
@endsection