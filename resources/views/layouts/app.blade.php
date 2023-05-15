<html>
    @include('layouts.includes.head')
    <body>
        @include('layouts.includes.header')
        <div id="app">
            <main class="py-4">
                @yield('content')
            </main>
        </div>
    </body>
    @include('layouts.includes.footer')
</html>
