@extends('web.layout')
@section('title')
    Reset Password
@endsection
@section('content')

    <!-- Contact -->
    <div id="contact" class="section">

        <!-- container -->
        <div class="container">

            <!-- row -->
            <div class="row">

                <!-- login form -->
                <div class="col-md-6 col-md-offset-3">
                    <div class="contact-form">
                        <h4>Sign In</h4>
                         
                         {{-- @if (session('status'))
                         <div id="success-email" class="alert alert-success"">        
                         </div>
                        @endif --}}
                        <form id="form-login" method="post" action="{{ url('/reset-password') }}">
                            @csrf
                            <p id="name_error" style="color: tomato" > </p>
                            <input value="{{ old("email") }}" class="input @error('email') is-invalid @enderror " type="email" name="email" placeholder="Email">
                            <p id="email_error" style="color: tomato" >
                                @error('email')
                                {{ $message }}
                            @enderror
                           </p>
                            <input class="input @error('password') is-invalid @enderror " type="password" name="password" placeholder="Password">
                            <p id="password_error" style="color: tomato" >   @error('password')
                                {{ $message }}
                            @enderror </p>
                            <input class="input" type="password" name="password_confirmation" placeholder="Confirm Password">
                            <input type="hidden" name="token" value="{{ request()->route('token') }}"> 
                            <button id="login-btn" type="submit" class="main-button icon-button pull-right">password reset</button>
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
    {{-- <script>
        $('#login-btn').click(function(e) {
            $('#email_error').text('');
           $('#password_error').text('');
            $('#password-error').text('');
            e.preventDefault()
            var formData = $('#form-login').serialize()
            // console.log(formData);
            $.ajax({
                type: 'POST',
                url: "{{ url('/reset-password') }}",
                data: formData,
                success: function(databack) {
                    // $('#success-email').show()
                    //     $('#success-email').text('Your Password has been reset successfully')
                    //     $('#success-email').text('');
                    window.location.href = '/login'
                },
                error: function(xhr, status, error) {
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        $('#' + key + '_error').text(value[0]);
                    });
                }
            })
        })
    </script> --}}
@endsection
