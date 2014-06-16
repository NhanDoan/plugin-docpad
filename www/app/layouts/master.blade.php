<!-- Stored in app/views/layouts/master.blade.php -->

<html>
    <head>
        <!-- build:css assets/stylesheets/main.css -->
        <link rel="stylesheet" href="assets/stylesheets/main.css">
        <!-- endbuild -->

        <!-- build:js assets/javascripts/frontend.js -->
            <script src="assets/javascripts/frontend.js"></script>
        <!-- endbuild -->
    </head>
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