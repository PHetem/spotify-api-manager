<div class="border rounded player-track">
    @if (!is_null($data['track']))
        <span class="track-name">{{ $data['track']->name }}</span>
        <div class="player-button-x-sm">
            <a data-bs-toggle="modal" href="#queueModal">
                <img src="{{ asset('img/player/queue-grey.png') }}" class="player-button-x-sm">
            </a>
        </div>
    @endif
</div>

