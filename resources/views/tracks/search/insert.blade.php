<div class="row" style="margin: 1em;">
    <div class="col-9">
        <input type="text" name="query" id="query" style="width: -webkit-fill-available; border-radius: 0.4rem;" placeholder="Search" required>
    </div>
    <div class="col-3">
        <button onclick="switchView('.modal-body', '{{ route('tracks.search.list', $customerID) }}', {query: $('#query').val()})" class="btn btn-success add-queue-bt">
            {{ ('Search') }}
        </button>
    </div>
</div>
