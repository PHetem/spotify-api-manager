@section('title'){{ 'Available Devices' }}@overwrite


<div id="content">
    @if (empty($devices))
        <div class="table-pos">
            <div style="margin: 100px;">
                <span class="main-title">No Devices Available</span>
                <p><span class="sub-title">Spotify must be opened on a device for it to become available</span></p>
            </div>
        </div>
    @else
        <table class="table table-striped table-rounded" style="margin-bottom: 0px;">
            @foreach ($devices as $device)
                @include('device.device', ['device' => $device])
            @endforeach
        </table>
        <div style="float: right; margin: 15px;">
            <input type="button" class="btn btn-success" value="Select Device" data-bs-dismiss="modal" route="{{route('customers.details.device.set', $customerID)}}" onclick="selectDevice(this)">
        </div>
    @endif
</div>

<script>
    function selectDevice(elem) {
        {query: $('#query').val()}
        let requestData = {'selected_device':$('input[name="selected_device"]:checked').val()};
        let requestURL = elem.getAttribute('route');

        $.ajax({
                url: requestURL,
                data: requestData,
                type: 'GET',
                success: function(response){
                    $('#deviceModal').modal('hide');
                }
        });
    }
</script>