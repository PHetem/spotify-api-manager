@extends('layouts.modal')
@section('modal_id'){{ 'queueModal' }}@overwrite

@include('tracks.queue.list')

<script>
    $(document).ready(function (){

        $('#modalBasic').on('hidden.bs.modal', function () {
            switchView('.modal-body', "{{ route('tracks.queue', $customerID) }}");
        })
    })
</script>