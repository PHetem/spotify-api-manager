<tr>
    <td>
        <div style="display: flex; margin: 0 .5em">
            <div>
                <img src="{{ $track['album']['images'][0]['url'] }}" class="queue-album">
            </div>
            <div>
                <span class="queue-track">{{ $track['name'] }}</span>
                <br>
                <span class="queue-artist">{{ $track['artists'][0]['name'] }}</span>
            </div>
        </div>
    </td>
</tr>