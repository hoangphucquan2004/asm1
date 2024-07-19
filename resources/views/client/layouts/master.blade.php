<!DOCTYPE html>
<html lang="en-us">
<head>
    @include('client.layouts.head')
</head>

<body>
    <!-- navigation -->
    <header class="navigation fixed-top">
        @include('client.layouts.nav')
    </header>

    @yield('content')

    <footer class="footer">
        @include('client.layouts.footer')
    </footer>
    @include('client.layouts.script')

</body>

</html>

