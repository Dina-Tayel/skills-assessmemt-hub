@extends('web.layout')
@section('title')
    Contact Us
@endsection
@section('content')
    <!-- Hero-area -->
    <div class="hero-area section">

        <!-- Backgound Image -->
        <div class="bg-image bg-parallax overlay" style="background-image:url(uploads/img/page-background.jpg)"></div>
        <!-- /Backgound Image -->

        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 text-center">
                    <ul class="hero-area-tree">
                        <li><a href="index.html">Home</a></li>
                        <li>Contact</li>
                    </ul>
                    <h1 class="white-text">{{ __('web.getInTouch') }}</h1>

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

                <!-- contact form -->
                <div class="col-md-6">
                    <div class="contact-form">
                        @include('web.inc.messages-ajax')
                        <h4>{{ __('web.sendMessage') }}</h4>
                        <form id="contact-form" method="" action="">
                            @csrf
                            <input class="input @error('name') is-invalid @enderror " name="name" id="name" type="text" name="name"
                                placeholder="{{ __('web.name') }}">
                           
                                <p id="name_error" style="color: tomato" > </p>
                         
                            <input class="input" name="email" type="email" name="email" id="email"
                                placeholder="{{ __('web.email') }}">
                            
                                <p id="email_error" style="color: tomato"> </p>
                           
                            <input class="input" name="subject" type="text" id="subject"
                                placeholder="{{ __('web.subject') }}">
                            
                                <p id="subject_error" style="color: tomato"> </p>
                            
                            <textarea class="input" name="body" id="body" placeholder="{{ __('web.body') }}"></textarea>
                            
                                <p id="body_error" style="color: tomato"> </p>
                            
                            <button id="contact-form-btn" class="main-button icon-button pull-right"
                                type="submit">{{ __('web.send') }}</button>
                        </form>
                    </div>
                </div>
                <!-- /contact form -->

                <!-- contact information -->
                <div class="col-md-5 col-md-offset-1">
                    <h4>{{ __('web.contactInfo') }}</h4>
                    <ul class="contact-details">
                        <li><i class="fa fa-envelope"></i><a  target="_blank" href="mailto:{{ $settings->email  }}">{{ $settings->email }}</a></li>
                        <li><i class="fa fa-phone"></i><a target="_blank" href="tel:{{ $settings->phone }}">{{ $settings->phone }}</a></li>
                    </ul>
                </div>
                <!-- contact information -->

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
            // $('#errors-msg').hide()
            $('#contact-form-btn').click(function(e){
            $('#success-msg').hide()
            // $('#errors-msg').hide()
            $('#success-msg').empty()
            // $('#errors-msg').empty()
            $('#name_error').text('');
            $('#email_error').text('');
            $('#subject_error').text('');
            $('#body_error').text('');
            e.preventDefault();
            let formData=$('#contact-form').serialize();
            // console.log("{{ url('/send/message') }}");
            $.ajax({
                type:"post",
                url:"{{ url('contact/send/message') }}",
                data:formData,
                success: function(data)
                 {
                    $('#success-msg').show()
                    $('#success-msg').text(data.success)
                    $('#contact-form')[0].reset();
                    // console.log(data.success)
                },error:function(xhr,status,error)
                {
                   $.each(xhr.responseJSON.errors,function(key,value){
                       $('#' + key + '_error'). text(value[0]);
                   });
                }
                // if you want to show all errors 
                // error:function(xhr,status,error)
                // {
                //     $('#errors-msg').show()
                //     $.each(xhr.responseJSON.errors,function(key,item){
                //         $('#errors-msg').append("<p id="">" + item +  "</p>")
                //     });
                // }
            })
        })
    </script>
@endsection
