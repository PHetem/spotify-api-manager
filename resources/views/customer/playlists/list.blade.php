<div class="row">
    <span class="cardTitle">Playlists</span>
</div>
<div class="card h-100" style="overflow: auto">
    <div class="card-body">
        <div class="container">
            <div class="row">
                @foreach ($customer->playlists as $playlist)
                    @php
                        $playlistName = strlen($playlist->name) > 20 ? substr($playlist->name, 0, 20) . '...' : $playlist->name;
                    @endphp
                    <a href="{{ $playlist->URL }}" class="linkdiv col-4 mt-3 ">
                        <div>
                            <img width="100" height="100" class="border rounded" src="{{ asset($playlist->coverImageURL) }}">
                        </div>
                        <div>
                            <span><b>{{ $playlistName }}</b></span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>