<!-- Stored in app/views/layouts/master.blade.php -->

<html>
    <body>
        @section('sidebar')
            This is the master sidebar.
        @show

        <div class="container">
            @yield('content')
        </div>
        @section('footer')
        	This is the footer
        @show
    </body>
    <script type="text/javascript" src="{{ asset('assets/javascript/frontend-min.js') }}"></script>
</html>