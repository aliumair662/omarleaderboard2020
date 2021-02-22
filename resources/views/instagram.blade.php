@extends('layouts.app')

@section('content')


    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="login-form-wrapper">
                        <div class="login-form">
                            <div class="login-logo text-center mb-4">
                                <h3 class="Price-Amount-heading giveaway">Enter your Instagram @name so we can identify you on The Leaderboard !</h3>
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                            </div>
                            <form method="POST" action="{{ route('addinstagram') }}">
                                @csrf
                                <div class="instagram Signup-input-group d-flex">
                                   <div class="input-group-prepend instagram">
                                       <span class="input-group-text" id="basic-addon1">@</span>
                                  </div>
                                    <input id="instagramUsername" type="text" placeholder="instagram Username" class="@error('instagramUsername') is-invalid @enderror" name="instagramUsername" value=""  autocomplete="name" autofocus>
                                    @error('instagramUsername')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="Signup-password mt-4 pt-1">
                                    
                                    <div class="login-input-group text-center submit-input">
                                        <button type="submit" class="login-submit">
                                            Add  instagram Account
                                        </button>
                                    </div>
                                </div>
                                <div class="mt-5 login-form-Forgot text-center">
                                        <p>
                                            No password required! Your Instagram @name will only be used to link you to your Instagram account on The Leaderboard.
                                        </p>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
