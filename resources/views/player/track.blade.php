@php
    $isPlaying = $data['playingState']->value == 'off';
@endphp
<div class="border rounded player-track-border">
@if (!is_null($data['track']))
    <div class="player-track">
        <div class="player-button-x-sm" style="align-self: center;">
            <a data-bs-toggle="modal" href="#deviceModal">
                <img src="{{ asset('img/player/selector-grey.png') }}" class="player-button-x-sm" style="height: 20px; width: 20px;">
            </a>
        </div>
        <div style="margin: auto;">
            <span class="track-name">{{ $data['track']->name }}</span>
        </div>
        <div class="player-button-x-sm-right">
            <a data-bs-toggle="modal" href="#queueModal">
                <img src="{{ asset('img/player/queue-grey.png') }}" class="player-button-x-sm">
            </a>
        </div>
    </div>
    <div id="progressBar" class="player-track-progress" style="width: {{ $data['track']['progressPercentage'] }}%"></div>
@endif
</div>
<script>
    clearInterval(progressIntervalID)

    var width = {{ $data['track']['progressPercentage'] ?? 100}};
    var progressIntervalID = setInterval(function () {

        if (!!document.getElementById('progressBar') && {{ json_encode($isPlaying) }}) {
            if (width >= 100)
                clearInterval(progressIntervalID)

            width = width + ({{ $data['track']['secondPercentage'] ?? 1}} * 2);

            document.getElementById('progressBar').style.width = width + '%';
        }
    }, 2000);
</script>
