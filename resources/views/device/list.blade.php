@section('title'){{ 'Available Devices' }}@overwrite

<div id="content">
    <table class="table table-striped table-rounded" style="margin-bottom: 0px;">
        @foreach ($devices as $device)
            @include('device.device', ['device' => $device])
        @endforeach
    </table>
    <div style="float: right; margin: 15px;">
        <input type="button" class="btn btn-success" value="Select Device" data-bs-dismiss="modal" route="{{route('customers.details.device.set', $customerID)}}" onclick="selectDevice(this)">
    </div>
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