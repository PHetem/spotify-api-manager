<tr>
    <td>
        <div style="display: flex; margin: 0 0; align-items: center;" class="row">
            <div class="col-2">
                <img src="{{ $track->image }}" class="queue-album">
            </div>
            <div class="col-8" style="padding-left: 0px;">
                <span class="queue-track">{{ $track->name }}</span>
                <br>
                <span class="queue-artist">{{ $track->artist }}</span>
            </div>
            <div class="col-2">
                <button style="float: right;" onclick="switchView('.modal-body', '{{ route('tracks.queue.add', $customerID) }}', {uri: '{{ $track->uri }}', _token: '{{ csrf_token() }}'}, 'POST')" class="btn btn-success add-queue-bt">
                    {{ ('+') }}
                </button>
            </div>
        </div>
    </td>
</tr>