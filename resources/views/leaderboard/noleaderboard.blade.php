@extends('layouts.app')

@section('content')
<div class="wrapper">
    <div class="container-fluid site-wrapper front-screen-height">
        <div class="row">
            <div class="col-12">
                <div class="Payment-Method-header">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="prize-button exit-button">
								<a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><button class="btn"><i class="fa fa-sign-out-alt"></i>Exit Game</button></a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
							</div>
                            
                        </div>
                    </div>
                </div>
                <div class="price-amount-wrapper mini-price-amount-wrapper">
                    <div class="login-form-wrapper Play-Now-wrapper">
                        <div class="login-form">
                            <div class="login-logo text-center">
                                <p class="mb-1 Manage-competition-text">There is no currently <br> no leaderboard giveaways live</p>
                                <p class="mb-3">Please come back soon!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
