@extends('layouts.app')

@section('content')
<div class="wrapper Play-Now-wrapper" style="height: 100%;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="login-form-wrapper">
                    <input type="hidden" name="active-leaderboad-single" id="active-leaderboad-single" value="{{(!empty($leaderboard->active) && $leaderboard->active==1) ? $leaderboard->id : ''}}">
                    <div class="login-form">
                        <div class="login-logo  text-center mb-5">
                         <h3 class="Price-Amount-heading giveaway">{{__('message.login-giveaway')}}</h3>
                        </div>
                        <form method="POST" action="{{ route('login',app()->getLocale()) }}">
                            @csrf
                            <div class="login-input-group">
                                <input id="email" type="email" placeholder="{{__('message.email')}}" class="login-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" required autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="login-input-group">
                                <input id="password" type="password" placeholder="{{__('message.password')}}" class="login-input @error('password') is-invalid @enderror" name="password"  autocomplete="current-password" required>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                           
                            <div class="login-input-group " style="display: none;">
                                <input id="instagramUsername" type="text" placeholder="{{__('message.instagram-username')}}" class="@error('instagramUsername') is-invalid @enderror" name="instagramUsername" value="{{ old('instagramUsername') }}"  autocomplete="name" autofocus>
                                @error('instagramUsername')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                            </div>

                            <div class="login-input-group text-center submit-input">
                                <button type="submit" class="login-submit">
                                    {{__('message.login-button')}}
                                </button>
                            </div>
                        </form>
                        <div class="login-form-Forgot text-center">
                            <a href="{{ route('password.request',app()->getLocale()) }}" class="login-Forgot text-white"><u>{{__('message.login-Forgot')}}</u></a>
                        </div>
                        <div class="mt-5 login-form-Forgot text-center">
                            <p>
                                {{__('message.login-dont-have-account')}} <a href="{{route('register',app()->getLocale())}}" class="login-to-Sign"><u>{{__('message.login-to-Sign')}}</u></a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="row leaderboard-search" style="padding: 0px;">
                    <div class="col-md-12 text-center">
                        <h4>THE LIVE LEADERBOARD</h4>
                    </div>
                </div>
            </div>
            <div class="col-12 text-center">
                <div class="leaderboard-table" id="leaderboard-table">
                    <div class="row leaderboard-bar-table table-title-bar m-0">

<div class="col-3 text-left">

<div class="prize">

<h4>Position</h4>

</div>

</div>

<div class="col-3">

<div class="name text-left">

<h4>Username</h4>

</div>

</div>

<div class="col-6 text-right">

<div class="points">

<h4>Mentions</h4>

</div>

</div>

</div>

                    @if(!empty($leaderboard->post_mentions))
                        <?php
                        $color_array = array('light-bg', 'dark-orange', 'light-bg dark-orange');
                        $k = count($color_array);
                        $i=0;
                        $p=1;
                        $FinalMentions=$leaderboard->post_mentions;
                        ?>

                        @foreach($FinalMentions as $Mentions)
                            <?php
                            $class= $color_array[$i % $k];
                            ?>
                            <div class="row leaderboard-details mentions-row {{$class}} m-0 data-row ownerId_{{$Mentions->ownerId}}"  data-username="{{$Mentions->ownername}}" data-mention="{{$Mentions->totalMentiones}}" >
                                <div class="col-3 text-left">
                                    <div class="prize">
                                        <h4 class="poition-no">{{$p}}</h4>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="name">
                                        <div class="account">
                                            <div class="table-avatar">
                                                <img class="mr-2" src="{{$Mentions->ownername_profile_pic_url}}" alt="">
                                                <span><h4>{{$Mentions->ownername}}</h4></span>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-6 text-right">
                                    <div class="points">
                                        <h4 id="total_mentions_{{$Mentions->ownerId}}">{{$Mentions->totalMentiones}}</h4>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $i++;
                            $p++;
                            ?>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@section('title')
The Leaderboard - Log in to your account
@endsection
@section('description')
Log in to your live Leaderboard account to and win amazing prizes today
@endsection