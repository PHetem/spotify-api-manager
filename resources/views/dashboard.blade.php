@extends('layouts.app')
@section('content')
<div class="table-pos">
    <div style="margin-top: 100px;">
        @if ($customers->isEmpty())
            <span class="main-title">No Customers found</span>
            <p><span class="sub-title">Authorized users will show up here</span></p>
        @else
        <div class="table-title">
            <span  class="main-title">Customers</span>
            </div>
            <table class="table table-striped table-half">
                <tr>
                    <td style="width:85%"><b>Name</b></td>
                    <td style="width:15%"><b>Remove</b></td>
                </tr>
                @foreach ($customers as $customer)
                    <tr>
                        <td>
                            <a href="{{ route('customers.details', $customer->id) }}"><b>{{ $customer->name }}</b></a>
                        </td>
                        <td>
                            <a href="{{ route('customers.delete', $customer->id) }}" onclick="return confirm('Are you sure?')" style="display: block; text-align: center;">
                                <img class="icon" src="{{ asset('img/delete.ico') }}">
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