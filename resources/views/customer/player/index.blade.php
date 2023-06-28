

@php
    $buttonsData = [
        ['action' => 'shuffle',  'image' => $playback['shuffleState']->image, 'route' => $playback['shuffleState']->route, 'state' => $playback['shuffleState']->value, 'small' => true],
        ['action' => 'previous', 'image' => 'img/player/previous.png',        'route' => 'customers.details.playback.track'],
        ['action' => 'playing',  'image' => $playback['playingState']->image, 'route' => $playback['playingState']->route, 'state' => $playback['playingState']->value],
        ['action' => 'next',     'image' => 'img/player/next.png',            'route' => 'customers.details.playback.track'],
        ['action' => 'repeat',   'image' => $playback['repeatState']->image,  'route' => $playback['repeatState']->route,  'state' => $playback['repeatState']->value,  'small' => true]
    ];
@endphp
<div id="player">
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
                    @foreach ($buttonsData as $button)
                        @include('customer.player.button', ['data' => $button, $customerID])
                    @endforeach
                </div>
                @include('customer.player.track', ['data' => $playback])
            </div>
        </div>
        <div class="col-2 center-img">
            <a href="{{ route('customers.refresh', $customerID) }}" class="center-img">
                <img src="{{ asset('img/player/refresh.png') }}" class="player-bt">
            </a>
        </div>
    </div>
    <a href="{{ route('customers.details.playback', $customerID) }}" style="display: none;" class="player-auto-refresh"></a>
</div>
<script>
    $('a.player-bt-sel').click(function (e) {
        e.preventDefault();
        updatePlayer($(this).attr('href'));
    });

    function updatePlayer(href) {
        $('#player').load(href);
    }

    $(function(){
        let href = $('a.player-auto-refresh').attr('href');
        setInterval(updatePlayer, 10000, href);
    });
</script>