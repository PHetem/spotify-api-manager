<div class="row">
    <span class="cardTitle">Saved Albums</span>
</div>
<div class="card h-100" style="overflow: auto">
    <div class="card-body">
        <div class="container">
            <div class="row">
                @foreach ($customer->albums as $album)
                    @php
                        $albumName = strlen($album->name) > 23 ? substr($album->name, 0, 20) . '...' : $album->name;
                    @endphp
                    <a href="{{ $album->URL }}" class="linkdiv col-6 mt-3 ">
                        <div>
                            <img width="100" height="100" class="border rounded" src="{{ asset($album->coverImageURL) }}">
                        </div>
                        <div>
                            <span><b>{{ $albumName }}</b></span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>