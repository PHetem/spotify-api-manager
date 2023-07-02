<tr>
    <td>
        <div style="display: flex; margin: 0 0; align-items: center;" class="row">
            <div class="col-2">
                <img src="{{ $track->image }}" class="queue-album">
            </div>
            <div class="col-10" style="padding-left: 0px;">
                <span class="queue-track">{{ $track->name }}</span>
                <br>
                <span class="queue-artist">{{ $track->artist }}</span>
            </div>
        </div>
    </td>
</tr>