<div class="row">
    <span class="cardTitle">Saved Tracks</span>
</div>
<div class="card h-100" style="overflow: auto">
    <div class="card-body">
        <div class="container">
            <div class="row">
                @foreach ($customer->tracks as $track)
                    @php
                        $trackName = strlen($track->name) > 23 ? substr($track->name, 0, 20) . '...' : $track->name;
                    @endphp
                    <a href="{{ $track->URL }}" class="linkdiv col-6 mt-3 ">
                        <div>
                            <img width="100" height="100" class="border rounded" src="{{ asset($track->album->coverImageURL) }}">
                        </div>
                        <div>
                            <span><b>{{ $trackName }}</b></span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>