<tr>
    <td>
        <div style="display: flex; margin: 0 .5em">
            <div>
                <img src="{{ $track->image }}" class="queue-album">
            </div>
            <div>
                <span class="queue-track">{{ $track->name }}</span>
                <br>
                <span class="queue-artist">{{ $track->artist }}</span>
            </div>
        </div>
    </td>
</tr>