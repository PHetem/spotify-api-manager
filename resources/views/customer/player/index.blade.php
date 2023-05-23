

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
                @include('customer.player.button', ['data' => ['state' => $playback['shuffleState']['value'], 'image' => $playback['shuffleState']['image'], 'route' => 'customers.details.playback.switch.shuffle', 'size' => 'small']])
                @include('customer.player.button', ['data' => ['image' => 'img/player/previous.png', 'route' => 'customers.details.playback.previous']])
                @include('customer.player.button', ['data' => ['state' => $playback['playingState']['value'], 'image' => $playback['playingState']['image'], 'route' => 'customers.details.playback.switch.play']])
                @include('customer.player.button', ['data' => ['image' => 'img/player/next.png', 'route' => 'customers.details.playback.next']])
                @include('customer.player.button', ['data' => ['state' => $playback['repeatState']['value'], 'image' => $playback['repeatState']['image'], 'route' => 'customers.details.playback.switch.repeat', 'size' => 'small']])
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
