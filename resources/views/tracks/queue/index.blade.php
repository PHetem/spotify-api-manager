@extends('layouts.modal')

@include('tracks.queue.list')

<script>
    $(document).ready(function (){

        $('#modalBasic').on('hidden.bs.modal', function () {
            switchView("{{ route('tracks.queue', $customerID) }}");
        })
    })
</script>