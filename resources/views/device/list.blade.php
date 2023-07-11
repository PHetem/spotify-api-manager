@section('title'){{ 'Available Devices' }}@overwrite

<div id="content">
    <table class="table table-striped table-rounded" style="margin-bottom: 0px;">
        @foreach ($devices as $device)
            @include('device.device', ['device' => $device])
        @endforeach
    </table>
    <div style="float: right; margin: 15px;">
        {{-- <input type="button" class="btn btn-success" value="Select Device" onclick="selectDevice()"> --}}
    </div>
</div>

<script>
    // function selectDevice() {
    //     selected = $('input[name="selected_device"]:checked').val();
    // }
</script>