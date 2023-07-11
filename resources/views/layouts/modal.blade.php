<div class="modal fade" id="@yield('modal_id')" tabindex="-1" role="dialog" aria-labelledby="@yield('modal_id')_title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="@yield('modal_id')_title">@yield('title')</h5>
            </div>
            <div class="modal-body" style="padding: unset;">
                @yield('modal_content')
            </div>
        </div>
    </div>
</div>

<script>
    function switchView(elem, requestURL, requestData, requestType = 'GET') {
        $.ajax({
                url: requestURL,
                data: requestData,
                type: requestType,
                success: function(response){
                    $(elem).html(response);
                }
        });
    }
</script>