<tr>
    <td>
        <div style="display: flex; margin: 0 0; align-items: center;" class="row">
            <div class="col-2">
                <img src="{{ $device['icon'] }}" style="width: 50px;">
            </div>
            <div class="col-8">
                <span class="list-track">{{ $device['name'] }}</span>
                <br>
                <span class="list-artist">{{ $device['type'] }}</span>
                <input type="hidden" name="id_{{ $device['name'] }}" value="{{ $device['id'] }}">
            </div>
            <div class="col-2">
                <input type="radio" class="form-check-input" name="selected_device" id="selected_device_{{ $device['name'] }}" style="transform:scale(1.5);" {{ $device['is_active'] ? 'checked' : '' }} value="{{ $device['id'] }}">
            </div>
        </div>
    </td>
</tr>