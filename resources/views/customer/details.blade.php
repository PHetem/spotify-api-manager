<div class="row">
    <span class="cardTitle">Customer Details</span>
</div>
<div class="card h-100" style="overflow: auto">
    <div class="card-body">
        <div class="container">
            <div class="row">
                <div class="col-8">
                    <div>
                        <span><b>User ID:</b></span>
                        <span>{{ $customer->id }}</span>
                    </div>
                    <div style="margin-top: 15px;">
                        <span><b>Spotify ID:</b></span>
                        <span>{{ $customer->spotifyID }}</span>
                    </div>
                    <div style="margin-top: 15px;">
                        <span><b>Name:</b></span>
                        <span>{{ $customer->name }}</span>
                    </div>
                    <div style="margin-top: 15px;">
                        <span><b>Email:</b></span>
                        <span>{{ $customer->email }}</span>
                    </div>
                    <div style="margin-top: 15px;">
                        <span><b>Country:</b></span>
                        <span>{{ $customer->country }}</span>
                    </div>
                    <div style="margin-top: 15px;">
                        <span><b>Profile:</b></span>
                        <a href="{{ $customer->profileURL }}" target="_blank">Click here</a>
                    </div>
                    <div style="margin-top: 15px;">
                        <span><b>Access Token:</b></span>
                        <span>{{ $customer->accessToken }}</span>
                    </div>
                    <div style="margin-top: 15px;">
                        <span><b>Refresh Token:</b></span>
                        <span>{{ $customer->refreshToken }}</span>
                    </div>
                </div>
                <div class="col-4">
                    <div>
                        <img width="200" src="{{ asset($customer->profilePictureURL) }}">
                    </div>
                    <div style="margin-top: 15px;">
                        <span><b>{{ $customer->followerCount }} Followers</b></span>
                    </div>
                    <div style="margin-top: 15px;">
                        <span><b>{{ $customer->accountType }} User</b></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>