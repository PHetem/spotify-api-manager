@php
    $parameters['id'] = $customerID;
    $parameters['action'] = $data['action'];
    $buttonClassName = 'player-bt';

    if (isset($data['small']) && $data['small'])
        $buttonClassName .= '-sm';


    if (isset($data['state']))
        $parameters['state'] = $data['state'];

@endphp

<div class="{{ $buttonClassName }} center-img">
    <a href="{{ route($data['route'], $parameters) }}" class="center-img player-bt-sel">
        <img src="{{ asset($data['image']) }}" class="{{ $buttonClassName }}">
    </a>
</div>