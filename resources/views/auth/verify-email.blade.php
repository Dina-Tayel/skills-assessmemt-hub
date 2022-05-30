@extends('web.layout')
@section('title')
    Email Verification
@endsection

@section('content')
<div id="contact" class="section">
    <div class="container">
        <div class="row justify-content-center ">
            <div class="col-md-6 col-md-offset-3">

                {{-- @if (session('status') == 'verification-link-sent') --}}
                <div class="alert alert-success" role="alert">
                    {{ __('A new email verification link has been emailed to you!.') }}
                </div>
                {{-- @endif --}}

                {{-- {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }}, --}}
              <div class="contact-form">
                <form class="d-inline" method="POST" action="{{ url('email/verification-notification') }}">
                    @csrf
                    <button type="submit"
                        class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                </form>
              </div>

            </div>
        </div>
    </div>
    @endsection
