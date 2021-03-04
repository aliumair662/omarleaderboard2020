@extends('layouts.app')



@section('content')
 <div class="wrapper">
            <div class="container-fluid site-wrapper">
                <div class="row">
                    <div class="col-12">
                        <div class="Payment-Method-header">
                            <div class="row">
                                <div class="col-12 mobile-responcive text-center">
                                       <h3 class="Payment-Method-heading Price-Amount-heading">
										Buy Hours
									   </h3>
                                </div>
                            </div>
                        </div>
                        <div class="buy-chances-wrapper">
                            <div class="Prize-wrapper">
                                <div class="container">
                                    <div class="Prize-child">
                                        <div class="row buy-chances-row">
                                            <div class="col-6">
                                                <div class="count-chances"><span class="count-chances-limt">1</span> <span>HOUR</span></div>
                                            </div>
                                            <div class="col-6">
                                                <div class="buy-btn">
                                                    <a href="#">
                                                        <button type="button" class="Prize-View-btn" data-toggle="modal" data-target="#exampleModalCenter">Buy £{{$package->onehour}}</button>
                                                    </a>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content modal-custom-styling">
                                                                <div class="modal-header border-bottom-0">
                                                                    <p class="modal-title" id="exampleModalLongTitle">Are you sure you want to buy 1 Hour?</p>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row button_row">
                                                                        <div class="col-12">
                                                                            <div class="model-button-wrapper">
                                                                                <!-- Button trigger modal -->
                                                                                <button type="button" class="Complete-Purchase-btn" data-toggle="modal" data-target="#exampleModalCentersec">
                                                                                    Complete <br />
                                                                                    Purchase
                                                                                </button>
                                                                                <a href="">
                                                                                    <button class="Cancel-button">Cancel</button>
                                                                                </a>
                                                                            </div>
                                                                           
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="Prize-child">
                                        <div class="row buy-chances-row">
                                            <div class="col-6">
                                                <div class="count-chances"><span class="count-chances-limt">2</span> <span>HOURS</span></div>
                                            </div>
                                            <div class="col-6">
                                                <div class="buy-btn">
                                                    <a href="#">
                                                        <button type="button" class="Prize-View-btn" data-toggle="modal" data-target="#exampleModalCenter">Buy £{{$package->twohour}}</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="Prize-child">
                                        <div class="row buy-chances-row">
                                            <div class="col-6">
                                                <div class="count-chances"><span class="count-chances-limt">3</span> <span>HOURS</span></div>
                                            </div>
                                            <div class="col-6">
                                                <div class="buy-btn">
                                                    <a href="#">
                                                        <button type="button" class="Prize-View-btn" data-toggle="modal" data-target="#exampleModalCenter">Buy £{{$package->threehour}}</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="Prize-child">
                                        <div class="row buy-chances-row">
                                            <div class="col-6">
                                                <div class="count-chances"><span class="count-chances-limt">4</span> <span>HOURS</span></div>
                                            </div>
                                            <div class="col-6">
                                                <div class="buy-btn">
                                                    <a href="#">
                                                        <button type="button" class="Prize-View-btn" data-toggle="modal" data-target="#exampleModalCenter">Buy £{{$package->fourhour}}</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection
@section('title')
The Leaderboard - Buy Time
@endsection
@section('description')
Buy Time to earn points. Points equals prizes.
@endsection