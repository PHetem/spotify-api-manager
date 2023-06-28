@extends('layouts.modal')

@section('title'){{ 'Queue' }}@overwrite
@section('modal_content')

    @if (empty($queue))
        <div class="table-pos">
            <div style="margin: 100px;">
                <span class="main-title">No Tracks found</span>
                <p><span class="sub-title">Queued tracks will show up here</span></p>
            </div>
        </div>
    @else
        <table class="table table-striped table-half table-fit table-rounded">
            @foreach ($queue as $track)
                <tr>
                    <td>
                        <div style="display: flex; margin: 0 .5em">
                            <div>
                                <img src="{{ $track['album']['images'][0]['url'] }}" class="queue-album">
                            </div>
                            <div>
                                <span class="queue-track">{{ $track['name'] }}</span>
                                <br>
                                <span class="queue-artist">{{ $track['artists'][0]['name'] }}</span>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>
    @endif

@overwrite
