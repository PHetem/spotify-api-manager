@php
    $playbackStateButton = $playback['state'] ? 'img/player/pause.png' : 'img/player/play.png';
@endphp

<div style="height: 100%; background-color: #2D2D2D;" class="border rounded row">
    <div class="col-2" style="display:flex;">
        @if (!is_null($playback['track']))
            <a href="{{ $playback['track']->URL }}" target="_blank" style="width:70px; margin: auto; display: block;" >
                <img src="{{ $playback['track']->imageURL }}" style="width:110px; height:110px; border-radius:.4rem">
            </a>
        @endif
    </div>
    <div class="col-8">
        <div style="display: grid;">
            <div class="wrapper" style="margin: 0 auto;">
                <div style="width:100px; height: 100px; float:left; display:flex;">
                    <a href="{{ route('customers.details.playback.previous', $customer->id) }}" style="width:70px; margin: auto; display: block;" >
                        <img src="{{ asset('img/player/previous.png') }}" style="width:70px; height:70px;">
                    </a>
                </div>
                <div style="width:100px; height: 100px; float:left; display:flex;">
                    <a href="{{ route('customers.details.playback.switch', $customer->id) }}" style="width:70px; margin: auto; display: block;" >
                        <img src="{{ asset($playbackStateButton) }}" style="width:70px; height:70px;">
                    </a>
                </div>
                <div style="width:100px; height: 100px; float:left; display:flex;">
                    <a href="{{ route('customers.details.playback.next', $customer->id) }}" style="width:70px; margin: auto; display: block;" >
                        <img src="{{ asset('img/player/next.png') }}" style="width:70px; height:70px;">
                    </a>
                </div>
            </div>
            <div style="width:700px; height: 30px; margin-bottom:25px; text-align: center; margin: auto;" class="border rounded">
                @if (!is_null($playback['track']))
                    <span style="color: aliceblue;">{{ $playback['track']->name }}</span>
                @endif
            </div>
        </div>
    </div>
    <div class="col-2" style="display:flex;">
        <a href="{{ route('customers.refresh', $customer->id) }}" style="width:70px; margin: auto; display: block;" >
            <img src="{{ asset('img/player/refresh.png') }}" style="width:70px;">
        </a>
    </div>
</div>
