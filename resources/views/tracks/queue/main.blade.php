@include('tracks.queue.insert', ['customerID' =>  $customerID])

@if (empty($tracklist->tracks))
    <div class="table-pos">
        <div style="margin: 100px;">
            <span class="main-title">No Tracks found</span>
            <p><span class="sub-title">Queued tracks will show up here</span></p>
        </div>
    </div>
@else
    <table class="table table-striped table-rounded">
        @foreach ($tracklist->tracks as $track)
            @include('tracks.queue.track', ['track' => $track])
        @endforeach
    </table>
@endif