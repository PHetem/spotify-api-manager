<div class="col-4 tool-button">
    <a href="{{ route($data['route']) }}" class="linkdiv tool-button" style="border: 1px solid black;">
        <div style="display: grid; padding: 10px;">
            <div>
                <img width="80" height="80" style="float: left; padding: 10px" src="{{ asset($data['image']) }}">
            </div>
            <span class="sub-title" style="padding: 0 10%; text-align: left;">{{ $data['title'] }}</span>
            <span class="description" style="padding: 0 10%; text-align: left; text-wrp: pretty;">{{ $data['description'] }}</span>
        </div>
    </a>
</div>