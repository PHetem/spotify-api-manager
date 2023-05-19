<div class="row">
    <span class="cardTitle">Saved Artists</span>
</div>
<div class="card h-100" style="overflow: auto">
    <div class="card-body">
        <div class="container">
            <div class="row">
                @foreach ($customer->artists as $artist)
                    @php
                        $artistName = strlen($artist->name) > 23 ? substr($artist->name, 0, 20) . '...' : $artist->name;
                    @endphp
                    <a href="{{ $artist->profileURL }}" class="linkdiv col-6 mt-3 ">
                        <div>
                            <img width="100" height="100" class="border rounded" src="{{ asset($artist->profilePictureURL) }}">
                        </div>
                        <div>
                            <span><b>{{ $artistName }}</b></span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>