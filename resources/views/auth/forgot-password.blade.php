@extends('web.layout')
@section('title')
    Sign Up
@endsection
@section('content')
    <!-- Hero-area -->
    <div class="hero-area section">

        <!-- Backgound Image -->
        <div class="bg-image bg-parallax overlay"
            style="background-image:url({{ asset('uploads/img/page-background.jpg') }})"></div>
        <!-- /Backgound Image -->

        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 text-center">
                    <ul class="hero-area-tree">
                        <li><a href="index.html">Home</a></li>
                        <li>Sign In</li>
                    </ul>
                    <h1 class="white-text">Sign In to start exam</h1>

                </div>
            </div>
        </div>

    </div>
    <!-- /Hero-area -->

    <!-- Contact -->
    <div id="contact" class="section">

        <!-- container -->
        <div class="container">

            <!-- row -->
            <div class="row">

                <!-- login form -->
                <div class="col-md-6 col-md-offset-3">
                    <div class="contact-form">
                        <h4>Forget Password</h4>
                        @include('web.inc.messages-ajax')
                           
                                <form id="form-login" method="" action="">
                                    @csrf
                                    <input class="input" type="email" name="email" placeholder="Email">
                                    <p id="email_error" style="color: tomato"> </p>
                                    <button id="login-btn" type="submit" class="main-button icon-button pull-right">submit
                                        </button>
                                </form>
                            </div>
                    </div>
                    <!-- /login form -->

                </div>
                <!-- /row -->

            </div>
            <!-- /container -->

        </div>
        <!-- /Contact -->
    @endsection

    @section('scripts')
        <script>
            $('#success-msg').hide()
            $('#success-email').hide()
            $('#login-btn').click(function(e) {
                $('#email_error').text('')
                e.preventDefault()
                var formData = $('#form-login').serialize()
                // console.log(formData);
                $.ajax({
                    type: 'POST',
                    url: "{{ url('/forgot-password') }}",
                    data: formData,
                    success: function(databack) {
                        $('#success-email').show()
                        $('#success-email').text('we have emailed your password reset link')
                    },
                    error: function(xhr, status, error) {
                        $.each(xhr.responseJSON.errors, function(key, value) {
                            $('#' + key + '_error').text(value[0]);
                        });
                    }
                })
            })
        </script>
    @endsection
