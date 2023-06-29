@extends('layouts.modal')

@section('title'){{ 'Queue' }}@overwrite
@section('modal_content')

    @if (empty($queue->tracks))
        <div class="table-pos">
            <div style="margin: 100px;">
                <span class="main-title">No Tracks found</span>
                <p><span class="sub-title">Queued tracks will show up here</span></p>
            </div>
        </div>
    @else
        @include('customer.player.queue.insert', ['customerID' =>  $customerID])
        <table class="table table-striped table-half table-fit table-rounded">
            @foreach ($queue->tracks as $track)
                @include('customer.player.queue.track', ['track' => $track])
            @endforeach
        </table>
    @endif

@overwrite
