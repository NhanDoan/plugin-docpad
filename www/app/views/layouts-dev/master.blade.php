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
                <h2>Get Today’s Best VA Loan Rates</h2>
                <div class="desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sem mauris, eleifend in consectetur id, ornare <br/>vitae turpis. Pellentesque viverra gravida velit, eu vulputate risus scelerisque id.      </div>
                <div class="content">
                    <div class="row m-t-lg">
                        <form action="" id="getRates" method="post" name="getRates">
                            <div class="col-md-3">
                                <!-- include sidebar -->
                                @include('site.partials._sidebar')
                            </div>
                        </form>
                        <div class="col-md-9">
                            @yield('content')
                        </div>
                    </div>

                    <div class="row m-b-lg news">
                       @yield('news')
                    </div>
                </div>
            </section>

            <!-- include footer -->
            @include('layouts.footer')
        </div>

    </body>

    <!-- build:js assets/javascripts/frontend.js -->
        <script src="../../assets/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="../../assets/sass-bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="../../assets/javascripts/frontend.js"></script>
    <!-- endbuild -->
</html>