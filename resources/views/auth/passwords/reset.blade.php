@extends('layouts.app')

@section('content')
<div class="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="login-form-wrapper">
                    <div class="login-form">
                        <div class="login-logo text-center mb-4">
                            <img src="{{ asset('assets/logos/logo.svg') }}">
                        </div>
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="Signup-input-group">
                                <input id="email" type="email" placeholder="Email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="Signup-password mt-4 pt-1">
                                <div class="login-input-group">
                                    <input id="password" type="password" placeholder="Password" class="login-input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="login-input-group">
                                    <input id="password-confirm" type="password" placeholder="Confirm Password" class="login-input" name="password_confirmation" required autocomplete="new-password">
                                </div>
                                <div class="login-input-group text-center submit-input">
                                    <button type="submit" class="login-submit">
                                        Reset Password
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
