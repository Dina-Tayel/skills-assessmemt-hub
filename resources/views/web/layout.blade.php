<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Skills Hub @yield('title')</title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Lato:700%7CMontserrat:400,600" rel="stylesheet">

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="{{ asset('web/css/bootstrap.min.css') }}" />

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="{{ asset('web/css/font-awesome.min.css') }}">

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="{{ asset('web/css/style.css') }}" />

    <!-- Toaster Package -->
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

    @yield('css')

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>

<body>

    <!-- Header -->
    <header id="header">
        <div class="container">

            <div class="navbar-header">
                <!-- Logo -->
                <div class="navbar-brand">
                    <a class="logo" href="index.html">
                        <img src="{{ asset('uploads/img/logo.png') }}" alt="logo">
                    </a>
                </div>
                <!-- /Logo -->

                <!-- Mobile toggle -->
                <button class="navbar-toggle">
                    <span></span>
                </button>
                <!-- /Mobile toggle -->
            </div>

            <!-- Navigation -->
            <x-navbar></x-navbar>
            <!-- /Navigation -->

        </div>
    </header>
    <!-- /Header -->

    @yield('content')

    <!-- Footer -->
    <footer id="footer" class="section">

        <!-- container -->
        <div class="container">

            <!-- row -->
            <div id="bottom-footer" class="row">

                <!-- social -->
                <div class="col-md-4 col-md-push-8">
                    
                    <x-footer></x-footer>
                </div>
                <!-- /social -->

                <!-- copyright -->
                <div class="col-md-8 col-md-pull-4">
                    <div class="footer-copyright">
                        <span>&copy; Copyright 2021. All Rights Reserved. | Made with <i class="fa fa-heart-o"
                                aria-hidden="true"></i> by <a href="#">SkillsHub</a></span>
                    </div>
                </div>
                <!-- /copyright -->

            </div>
            <!-- row -->

        </div>
        <!-- /container -->

    </footer>
    <!-- /Footer -->

    <!-- preloader -->
    <div id='preloader'>
        <div class='preloader'></div>
    </div>
    <!-- /preloader -->


    <!-- jQuery Plugins -->
    <script type="text/javascript" src="{{ asset('web/js/jquery.min.js') }}"></script>
    <!-- Toaster -->
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    <!-- end toaster -->
    <script type="text/javascript" src="{{ asset('web/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web/js/main.js') }}"></script>
    <script>
        $('#logout-link').click(function(e){
            e.preventDefault()
            $('#form-logout').submit()
        })
    </script>
    {{-- <script> toastr.success('New Exam addedd');</script> --}}
    {!! Toastr::message() !!}
        <!-- pusher-->
        <script src="https://js.pusher.com/7.1/pusher.min.js"></script>
        <script>
      
          // Enable pusher logging - don't include this in production
          Pusher.logToConsole = true;
          var pusher = new Pusher('a010621fd2ce743268f5', {
            cluster: 'eu'
          });
          var channel = pusher.subscribe('notifications-channel');
          channel.bind('exam-added', function(data) {
            toastr.success('New Exam addedd');
          });
        </script>
        <!-- end pusher--->
      
       @yield('scripts')
</body>

</html>
