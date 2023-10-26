<div class="row">
    <span class="card-title">@yield('title')</span>
</div>
<div class="card h-100" style="overflow: auto">
    @if (isset($header))
        <div class="card-header">
            @yield('card_header')
        </div>
    @endif
    <div class="card-body">
        <div class="container">
            <div class="row">
                @yield('card_content')
            </div>
        </div>
    </div>
</div>


