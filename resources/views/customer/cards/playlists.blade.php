<div class="row">
    <span class="cardTitle">Playlists</span>
</div>
<div class="card h-100" style="overflow: auto">
    <div class="card-body">
        @php
            $playlists = [(object)['name' => 'Lorem', 'image' => 'img/user.png'], (object)['name' => 'Ipsum', 'image' => 'img/user.png'],
                            (object)['name' => 'Dolor', 'image' => 'img/user.png'], (object)['name' => 'Sit Amet', 'image' => 'img/user.png'],
                            (object)['name' => 'Lorem', 'image' => 'img/user.png'], (object)['name' => 'Ipsum', 'image' => 'img/user.png'],
                            (object)['name' => 'Dolor', 'image' => 'img/user.png'], (object)['name' => 'Sit Amet', 'image' => 'img/user.png']]
        @endphp

        <div class="container">
            <div class="row">
                @foreach ($playlists as $playlist)
                    <div class="col-4">
                        <div>
                            <img width="85" src="{{ asset($playlist->image) }}">
                        </div>
                        <div>
                            <span>{{ $playlist->name }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>