<div class="modal fade" id="modalBasic" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">@yield('title')</h5>
            </div>
            <div class="modal-body">
                @yield('modal_content')
            </div>
        </div>
    </div>
</div>

<script>
    function switchView(requestURL, requestData, requestType = 'GET') {
        console.log(requestData);
    $.ajax({
            url: requestURL,
            data: requestData,
            type: requestType,
            success: function(response){
                $('.modal-body').html(response);
            }
        });
    }
</script>