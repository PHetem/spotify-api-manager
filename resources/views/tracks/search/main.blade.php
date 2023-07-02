@include('tracks.search.insert')

@if (empty($tracklist->tracks))
    <div class="table-pos">
        <div style="margin: 100px;">
            <span class="main-title">No Tracks found</span>
            <p><span class="sub-title">Searched tracks will show up here</span></p>
        </div>
    </div>
@else
    <table class="table table-striped table-rounded">
        @foreach ($tracklist->tracks as $track)
            @include('tracks.search.track', ['track' => $track])
        @endforeach
    </table>
@endif