@extends('web.layout')
@section('title')
    Sign in
@endsection
@section('content')
				<!-- Hero-area -->
                <div class="hero-area section">

                    <!-- Backgound Image -->
                    <div class="bg-image bg-parallax overlay" style="background-image:url({{ asset('uploads/img/page-background.jpg') }})"></div>
                    <!-- /Backgound Image -->
                    <div class="container">
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1 text-center">
                                <ul class="hero-area-tree">
                                    <li><a href="index.html">Home</a></li>
                                    <li>Sign Up</li>
                                </ul>
                                <h1 class="white-text">Sign Up and estimate your skills</h1>
        
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
                                    <h4>Sign Up</h4>
                                    {{-- @include('web.inc.messages') --}}
                                    <form id="register-form" method="" action="">
                                        @csrf
                                        <input class="input @error('name') is-invalid @enderror" type="text" name="name" placeholder="Name">
                                        {{-- @error('name')
                                            {{ $message }}
                                        @enderror --}}
                                        <p id="name_error" style="color: tomato" > </p>
                                        <input class="input @error('email') is-invalid @enderror" type="email" name="email" placeholder="Email">
                                        <p id="email_error" style="color: tomato" > </p>
                                        <input class="input @error('password') is-invalid @enderror" type="password" name="password" placeholder="Password">
                                        <p id="password_error" style="color: tomato" > </p>
                                        <input class="input" type="password" name="password_confirmation" placeholder="Confirm Password">
                                        <button id="form-btn" type="submit" class="main-button icon-button pull-right">Sign Up</button>
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
    $('#form-btn').click(function(e){
        $('#name_error').text('');
        $('#email_error').text('');
        $('#password_error').text('');
        e.preventDefault()
        var formData=$('#register-form').serialize()
        // console.log(formData);
        $.ajax({
            type:'POST',
            url:"{{ url('register') }}",
            data:formData,
            success:function(databack){
                window.location.href = '/' 
            },error:function(xhr,status,error){
                $.each(xhr.responseJSON.errors,function(key,value){
                       $('#' + key + '_error'). text(value[0]);
                   });
            }
        })
    })
</script>
@endsection