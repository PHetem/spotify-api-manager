<div class="row">
    <span class="cardTitle">Podcasts</span>
</div>
<div class="card h-100" style="overflow: auto">
    <div class="card-body">
        <div class="container">
            <div class="row">
                @foreach ($customer->podcasts as $podcast)
                    @php
                        $podcastName = strlen($podcast->name) > 23 ? substr($podcast->name, 0, 20) . '...' : $podcast->name;
                    @endphp
                    <a href="{{ $podcast->URL }}" class="linkdiv col-6 mt-3 ">
                        <div>
                            <img width="100" height="100" class="border rounded" src="{{ asset($podcast->coverImageURL) }}">
                        </div>
                        <div>
                            <span><b>{{ $podcastName }}</b></span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>