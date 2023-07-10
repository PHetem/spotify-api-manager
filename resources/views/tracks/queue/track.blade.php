<tr>
    <td>
        <div style="display: flex; margin: 0 0; align-items: center;" class="row">
            <div class="col-2">
                <img src="{{ $track->image }}" class="list-album">
            </div>
            <div class="col-10" style="padding-left: 0px;">
                <span class="list-track">{{ $track->name }}</span>
                <br>
                <span class="list-artist">{{ $track->artist }}</span>
            </div>
        </div>
    </td>
</tr>