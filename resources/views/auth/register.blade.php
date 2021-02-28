@extends('layouts.app')

@section('content')


    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="login-form-wrapper">
                        <div class="login-form">
                            <div class="login-logo text-center mb-4">
                                <h3 class="Price-Amount-heading giveaway sign-up-text">{{__('message.sign-giveaway')}}</h3>
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                            </div>
                            <div class="login-logo text-center mb-4">
                                <script src="https://fast.wistia.com/embed/medias/25dnkl6jzk.jsonp" async></script><script src="https://fast.wistia.com/assets/external/E-v1.js" async></script><div class="wistia_responsive_padding" style="padding:56.25% 0 0 0;position:relative;"><div class="wistia_responsive_wrapper" style="height:100%;left:0;position:absolute;top:0;width:100%;"><div class="wistia_embed wistia_async_25dnkl6jzk videoFoam=true" style="height:100%;position:relative;width:100%"><div class="wistia_swatch" style="height:100%;left:0;opacity:0;overflow:hidden;position:absolute;top:0;transition:opacity 200ms;width:100%;"><img src="https://fast.wistia.com/embed/medias/25dnkl6jzk/swatch" style="filter:blur(5px);height:100%;object-fit:contain;width:100%;" alt="" aria-hidden="true" onload="this.parentNode.style.opacity=1;" /></div></div></div></div>
                            </div>

                            <form method="POST" action="{{ route('register',app()->getLocale()) }}">
                                @csrf
                                <div class="Signup-input-group">
                                    <input type="text" name="firstname" placeholder="{{__('message.firstname')}}">
                                    @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                                <div class="Signup-input-group">
                                    <input type="text" name="lastname" placeholder="{{__('message.lastname')}}">
                                    @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="Signup-input-group d-none">
                                    <input id="name" type="text" placeholder="Nick Name" class="@error('name') is-invalid @enderror" name="name" value="default"  autocomplete="name" autofocus>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="Signup-input-group">
                                    <input id="email" type="email" placeholder="{{__('message.email')}}" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="Signup-password mt-4 pt-1">
                                    <div class="login-input-group">
                                        <input id="password" type="password" placeholder="{{__('message.password')}}" class="login-input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="login-input-group">
                                        <input id="password-confirm" type="password" placeholder="{{__('message.password_confirmation')}}" class="login-input" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                    <div class="mt-5 login-form-Forgot text-left">
                                        <p>
                                            <input type="radio" class="Sign-radio mr-2">{{__('message.agree')}} <a href="#" class="login-to-Sign"><u>{{__('message.terms&conditions')}}</u></a>
                                        </p>
                                    </div>
                                    <div class="login-input-group text-center submit-input">
                                        <button type="submit" class="login-submit">
                                            Create Account
                                        </button>
                                    </div>
                                    <div class="mt-5 login-form-Forgot text-center">
                                <p>
                                    {{__('message.already-have-account')}} <a href="{{route('login',app()->getLocale())}}" class="login-to-Sign"><u>{{__('message.Sign-in')}}</u></a>
                                </p>
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
The Leaderboard - Sign up to The Leaderboard to win amazing prizes
@endsection
@section('description')
TheLeaderboard.io is a decentralised gaming platform. Players can win cash prizes and luxury goods by playing The Leaderboard games. Our games are accessible worldwide. Cash prizes will be paid out via Paypal and all non cash prizes will be posted worldwide free of charge. All games are based on skill and not by chance. We are not regulated by the gambling commission.
@endsection