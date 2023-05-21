@php
    $playbackStateButton = $playback['state'] ? 'img/player/pause.png' : 'img/player/play.png';
@endphp

<div class="border rounded row player-bg">
    <div class="col-2 center-img">
        @if (!is_null($playback['track']))
            <a href="{{ $playback['track']->URL }}" target="_blank" class="center-img" style="width:70px;" >
                <img src="{{ $playback['track']->imageURL }}" class="player-cover">
            </a>
        @endif
    </div>
    <div class="col-8">
        <div style="display: grid;">
            <div class="wrapper" style="margin: 0 auto;">
                <div class="player-bt center-img">
                    <a href="{{ route('customers.details.playback.previous', $customer->id) }}" class="center-img">
                        <img src="{{ asset('img/player/previous.png') }}" class="player-bt">
                    </a>
                </div>
                <div class="player-bt center-img">
                    <a href="{{ route('customers.details.playback.switch', $customer->id) }}" class="center-img">
                        <img src="{{ asset($playbackStateButton) }}" class="player-bt">
                    </a>
                </div>
                <div class="player-bt center-img">
                    <a href="{{ route('customers.details.playback.next', $customer->id) }}" class="center-img">
                        <img src="{{ asset('img/player/next.png') }}" class="player-bt">
                    </a>
                </div>
            </div>
            <div class="border rounded player-track">
                @if (!is_null($playback['track']))
                    <span style="color: aliceblue;">{{ $playback['track']->name }}</span>
                @endif
            </div>
        </div>
    </div>
    <div class="col-2 center-img">
        <a href="{{ route('customers.refresh', $customer->id) }}" class="center-img">
            <img src="{{ asset('img/player/refresh.png') }}" class="player-bt">
        </a>
    </div>
</div>
