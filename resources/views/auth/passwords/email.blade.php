@extends('layouts.app')

@section('content')

<div class="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="login-form-wrapper">
                    <div class="login-form">
                        <div class="login-logo text-center mb-4">
                             <h3 class="Price-Amount-heading giveaway">{{__('message.forgot-password-giveaway')}}</h3>
                        </div>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email',app()->getLocale()) }}">
                            @csrf
                            <div class="Signup-input-group">
                                <input id="email" type="email" placeholder="{{__('message.email')}}" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="Signup-password mt-4 pt-1">
                                <div class="login-input-group text-center submit-input">
                                    <button type="submit" class="login-submit">
                                        {{__('message.send-password-link')}}
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
@section('title')
The Leaderboard - Reset your password
@endsection
@section('description')
Enter your email to reset your password
@endsection
