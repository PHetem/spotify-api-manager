@php
    $buttonClassName = 'player-bt';
    if (isset($data['size']) && $data['size'] == 'small')
        $buttonClassName .= '-sm';

    $parameters['id'] = $customerID;

    if (isset($data['state']))
        $parameters['state'] = $data['state'];

    $parameters['action'] = $data['action'];
@endphp

<div class="{{ $buttonClassName }} center-img">
    <a href="{{ route($data['route'], $parameters) }}" class="center-img player-bt-sel">
        <img src="{{ asset($data['image']) }}" class="{{ $buttonClassName }}">
    </a>
</div>