<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <title>VA Loan Center
    </title>
    <meta name="description" content="va, loan, capitain, center, get real time pricing">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    {{ HTML::style('//maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css') }}
    {{ HTML::style('assets/stylesheets/main.css') }}
    
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

    {{ HTML::script('http://code.jquery.com/jquery-1.10.2.min.js') }}
    {{ HTML::script('//maxcdn.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js') }}
    {{ HTML::script('assets/javascript/main.js') }}
</html>