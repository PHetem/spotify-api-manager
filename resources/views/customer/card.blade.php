@extends('layouts.card')
@section('title'){{ $title }}@overwrite

@section('card_content')
    @if ($data->isEmpty())
        <span style="font-weight: bold; font-size: 1em;">User Has No {{ $title }} Available</span>
    @else
        @foreach ($data as $item)
            @php
                $itemName = strlen($item->name) > 23 ? substr($item->name, 0, 20) . '...' : $item->name;
            @endphp
            <a href="{{ $item->URL }}" target="_blank" class="linkdiv col-4 mt-3 ">
                <div>
                    <img width="100" height="100" class="border rounded" src="{{ asset($item->imageURL) }}">
                </div>
                <div>
                    <span><b>{{ $itemName }}</b></span>
                </div>
            </a>
        @endforeach
    @endif
@overwrite
