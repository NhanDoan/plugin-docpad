<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <title>VA Loan Center
    </title>
    <meta name="description" content="va, loan, capitain, center, get real time pricing">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
   

    <!-- build:css assets/stylesheets/main.css -->
    <link rel="stylesheet" type="text/css" href="../../assets/sass-bootstrap/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="../../assets/stylesheets/main.css"/>
    <!-- endbuild -->

    <link rel="shortcut icon" href="favicon.ico">
    </head>
    <body>
        <div class="container wrapper">
            <!-- include header -->
            @include('layouts.header')

            <section id="content">
                @yield('content')
            </section>

            <!-- include footer -->
            @include('layouts.footer')
        </div>
        @yield('modal')
    </body>

    <!-- build:js assets/javascripts/frontend.js -->
        <script src="../../assets/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="../../assets/sass-bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="../../assets/javascripts/jquery.currency.js"></script>
        <script src="../../assets/javascripts/frontend.js"></script>
    <!-- endbuild -->
    <script type="text/javascript">
        var baseUrl = '<?php echo Request::root() ?>';
        new VALOAN.Home().init({baseUrl: baseUrl});
    </script>
</html>
