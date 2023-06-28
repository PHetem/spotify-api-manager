<form method="post" action="{{ route('customers.details.queue.add', $customerID)}}" enctype="multipart/form-data">
    <div class="row" style="margin: 1em;">
        {{ csrf_field() }}
        <div class="col-8">
            <input type="text" name="trackID" style="width: -webkit-fill-available; border-radius: 0.4rem;" placeholder="Track ID" required>
        </div>
        <div class="col-4">
            <button type="submit" class="btn btn-success add-queue-bt">
                {{ ('Add to queue') }}
            </button>
        </div>
    </div>
</form>