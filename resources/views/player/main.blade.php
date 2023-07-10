

@php
    $buttonsData = [
        ['action' => 'shuffle',  'image' => $playback['shuffleState']->image, 'route' => $playback['shuffleState']->route, 'state' => $playback['shuffleState']->value, 'small' => true],
        ['action' => 'previous', 'image' => 'img/player/previous.png',        'route' => 'customers.details.playback.track'],
        ['action' => 'playing',  'image' => $playback['playingState']->image, 'route' => $playback['playingState']->route, 'state' => $playback['playingState']->value],
        ['action' => 'next',     'image' => 'img/player/next.png',            'route' => 'customers.details.playback.track'],
        ['action' => 'repeat',   'image' => $playback['repeatState']->image,  'route' => $playback['repeatState']->route,  'state' => $playback['repeatState']->value,  'small' => true]
    ];
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
                @foreach ($buttonsData as $button)
                    @include('player.button', ['data' => $button, $customerID])
                @endforeach
            </div>
            @include('player.track', ['data' => $playback])
        </div>
    </div>
    <div class="col-2 center-img">
        <a href="{{ route('customers.refresh', $customerID) }}" class="center-img">
            <img src="{{ asset('img/player/refresh.png') }}" class="player-bt">
        </a>
    </div>
</div>
@include('tracks.queue.index', ['tracklist' => $playback['queue'], $customerID])
<a href="{{ route('customers.details.playback', $customerID) }}" style="display: none;" class="player-auto-refresh"></a>

<script>
    function updatePlayer(href) {
        console.log(intervalID);
        console.log(Date.now()/1000);

        if (!isModalOpen()) {
            switchView('#player', href)
        }
    }

    function isModalOpen() {
        return $('#modalBasic').attr('aria-modal') == 'true';
    }

    function switchView(elem, requestURL, requestData = [], requestType = 'GET') {
        $.ajax({
                url: requestURL,
                data: requestData,
                type: requestType,
                success: function(response){
                    $(elem).html(response);
                }
        });
    }

    $(document).ready(function (){

        clearInterval(intervalID);
        $('a.player-bt-sel').click(function (e) {
            e.preventDefault();
            updatePlayer($(this).attr('href'));
        });

        let href = $('a.player-auto-refresh').attr('href');
        intervalID = setInterval(updatePlayer, 10000, href);
    });

</script>