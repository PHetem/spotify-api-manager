@extends('layouts.app')
@section('content')

@php
    $buttonsData = [
        ['title' => 'Create New',  'image' => 'img/playlist-tools/create.png', 'route' => 'playlists.tools.list', 'description' => 'Create a new playlist based on set parameters'],
        ['title' => 'Merge',  'image' => 'img/playlist-tools/merge.png', 'route' => 'playlists.tools.list', 'description' => 'Merge two or more playists'],
        ['title' => 'Remove Duplicates',  'image' => 'img/playlist-tools/duplicate.png', 'route' => 'playlists.tools.list', 'description' => 'Scan a playlist for duplicates'],
        ['title' => 'Compare',  'image' => 'img/playlist-tools/compare.png', 'route' => 'playlists.tools.list', 'description' => 'Compare two playlists'],
        ['title' => 'Purge',  'image' => 'img/playlist-tools/cleanup.png', 'route' => 'playlists.tools.list', 'description' => 'Clean up a playlist'],
    ];
@endphp

<div style="margin-top: 100px;">
    <div class="container" style="max-width: 1100px; padding: 100px">
        <div class="row justify-content-center" style="height: 200px;">
            @foreach ($buttonsData as $button)
                @include('playlistTools.button', ['data' => $button])
            @endforeach
        </div>
    </div>
</div>
@endsection
