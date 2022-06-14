@extends('web.layout')
@section('title')
    Profile
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
                    <h1 class="white-text">Profile</h1>

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

                <!-- Table -->
                <div class="col-md-6 col-md-offset-3">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Exam</th>
                        <th scope="col">Score</th>
                        <th scope="col">Time in minutes</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                 @foreach (Auth::user()->exams as $index=>$exam )
                 <th scope="row">{{ $index+1 }}</th>
                 <td>{{ $exam->name() }}</td>
                 <td>{{ $exam->pivot->score }}%</td>
                 <td>{{ $exam->pivot->max_time }} minute</td>
               </tr>
                 @endforeach
                      {{-- <tr>
                        <th scope="row">3</th>
                        <td colspan="2">Larry the Bird</td>
                        <td>@twitter</td>
                      </tr> --}}
                    </tbody>
                  </table>
                </div>
                <!-- /Table -->

            </div>
            <!-- /row -->

        </div>
        <!-- /container -->

    </div>
    <!-- /Contact -->
@endsection

@section('scripts')
    <script>
        $('#login-btn').click(function(e) {
            $('#email_error').text('');
            $('#password-error').text('');
            e.preventDefault()
            var formData = $('#form-login').serialize()
            // console.log(formData);
            $.ajax({
                type: 'POST',
                url: "{{ url('login') }}",
                data: formData,
                success: function(databack) {
                    window.location.href = '/'
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
