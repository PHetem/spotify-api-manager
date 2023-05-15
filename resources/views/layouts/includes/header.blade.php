<nav class="topnav navbar navbar-expand-md navbar-light shadow-sm">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                <a class="navbar-brand" href="{{ route('dashboard') }}">{{ config('app.name', 'Laravel') }}</a>
                @guest

                @else
                    @if (Request::segment(1) != '')
                        <div>
                            <a style="float: left;" href="{{ route('back') }}"><</a>
                            <span style="float: left;">{{ Request::segment(1) }}</span>
                        </div>
                    @endif
                @endguest
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Request::segment(1) != 'login' && Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Request::segment(1) != 'register' && Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item">
                        @if (Auth::user()->isAdmin) <a class="nav-link" href="{{ route('users.details', Auth::user()->id) }}"> @else <span> @endif
                            <img style="width:20px; height:20px; border:0" src="{{ asset('img/user.png') }}">
                            {{ Auth::user()->name }}
                        @if (Auth::user()->isAdmin)</a> @else </span> @endif
                    </li>

                    <li class="nav-item dropdown">

                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre></a>

                        @if (Auth::user()->isAdmin)
                            <a href="{{ route('logs.list') }}">Logs</a>
                            <a href="{{ route('users.list') }}">Manage Users</a>
                        @endif

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

