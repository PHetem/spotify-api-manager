@section('internal_content')

    @if (empty($devices))
        @include('device.warning')
    @else
        @include('device.list')
    @endif

@overwrite