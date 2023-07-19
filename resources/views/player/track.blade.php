<div class="border rounded player-track">
    @if (!is_null($data['track']))
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
    @endif
</div>

