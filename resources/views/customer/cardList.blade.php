@extends('layouts.card')
@section('title'){{ $title }}@overwrite

@section('card_content')
    <div style="display: block; padding: 0%; margin:0, -10px;">
        @if ($data->isEmpty())
            <span class="sub-title">User Has No {{ $title }} Available</span>
        @else
        <table class="table table-striped table-rounded">
            @foreach ($data as $item)
                @php
                    $itemName = strlen($item->name) > 23 ? substr($item->name, 0, 20) . '...' : $item->name;
                @endphp
                <tr>
                    <td>
                        <a href="{{ $item->URL }}" target="_blank" class="linkdiv" style="text-align: inherit">
                            <div style="display: flex; margin: 0 0; align-items: center;" class="row">
                                <div class="col-2">
                                    <span class="list-number">#{{ $item->rank }}</span>
                                </div>
                                <div class="col-2">
                                    <img src="{{ asset($item->imageURL) }}" class="list-album" style="margin-right: 0">
                                </div>
                                <div class="col-8">
                                    <span class="list-track-sm">{{ $itemName }}</span>
                                    <br>
                                    <span class="list-artist">{{ $item->artist }}</span>
                                </div>
                            </div>
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
        @endif
    </div>
@overwrite
