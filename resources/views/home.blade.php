@extends('layouts.app')



@section('content')

    @if(!empty($leaderboard))



        <input type="hidden" name="active-leaderboad-single" id="active-leaderboad-single" value="{{(!empty($leaderboard->active) && $leaderboard->active==1) ? $leaderboard->id : ''}}">

        <input type="hidden" name="instagramid" id="instagramid" value="{{Auth::user()->instagramid}}">

        <div class="wrapper" id="user_leaderboard" data-id="{{$leaderboard->id}}" data-endtime="{{$leaderboard->leaderboard_end_date}}" data-starttime="{{$leaderboard->leaderboard_start_date}}">

            <div class="container-fluid site-wrapper">

                <div class="row m-0">
                    <div class="col-12 col-md-12 order-md-2 order-2 mobile-leaderboard">

                        <div class="Payment-Method-header leaderboard-header position-relative">

                            <div class="row">

                            <div class="col-md-3 col-3 order-md-1 desktop order-1 text-left">
								<div class="prize-button exit-button">
								<a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><button class="btn"><i class="fa fa-sign-out-alt"></i>{{__('message.exit-game')}}</button></a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
								</div>
                            </div>
                                <div class="col-md-6 col-6 order-md-2 order-2 casino-timer leaderboard-timer text-center counter-width">

                                    <div class="row counter-width">

                                        <div class="col-12">

                                            <p>{{__('message.competitions-end-in')}}</p>

                                        </div>

                                        <div class="col-3 days"><h3 id="days">05</h3><p>{{__('message.days')}}</p></div>

                                        <div class="col-3 hours"><h3 id="hours">12</h3><p>{{__('message.hours')}}</p></div>

                                        <div class="col-3 mins"><h3 id="mins">26</h3><p>{{__('message.mins')}}</p></div>

                                        <div class="col-3 secs"><h3 id="secs">05</h3><p>{{__('message.secs')}}</p></div>

                                    </div>

                                </div>

                                <div class="col-md-3 col-3 order-3 order-md-3 prize-table text-right">

                                    <div class="prize-button">

                                        <button class="btn"><i class="fa fa-gift"></i><a href="https://www.instagram.com/s/aGlnaGxpZ2h0OjE3ODU1MDg1OTExNDY4MDI3?igshid=wu57rjjq2cco&story_media_id=2504848121957656095" target="_blank" style="color: white">{{__('message.see-prizes')}}</a></button>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-12 col-md-12 order-md-3 order-3 mobile-leaderboard">

                        <div class="leaderboard-bar">
                             @if(!empty($leaderboard->myposition))
                           <p id="onlederboard" >{{__('message.you-are')}} <span class="mr-1 ml-1" id="myposition">&nbsp;{{$leaderboard->myposition}}&nbsp;</span> {{__('message.out-of')}} <span id="total-position">{{$leaderboard->totalposition}}</span> {{__('message.players')}}</p>
                            @else
                                <p id="notonlederboard">{{__('message.not-on-the-live-leaderboard')}}</p>
                            @endif
                        </div>

                        <div class="leaderboard-bar {{!empty($leaderboard->awaymessage) ?  : 'd-none'}}" id="away_message">
                            @if(!empty($leaderboard->awaymessage))
                                <p >{{$leaderboard->awaymessage}}</p>
                            @endif
                        </div>


                    </div>
                    <div class="col-12 col-md-12 order-md-4 order-6 mt-4 mobile-leaderboard" style="display: none">

                        <div class="Payment-Method-header leaderboard-header buyer-header position-relative">

                            <div class="row">

                                <div class="col-md-3 col-3 order-md-1 desktop order-1 text-left">
                                    <div class="prize-button exit-button">
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();"><button class="btn">Buy Time</button></a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                    </div>
                                </div>

                                <div class="col-md-6 col-6 order-md-2 order-2 casino-timer leaderboard-timer text-center counter-width">

                                    <div class="row counter-width buy-time">

                                        <div class="col-12">

                                            <p>COMPETITION ENDS IN</p>

                                        </div>

                                        <div class="col-4 hours"><h3 id="hours">12</h3><p>Hours</p></div>

                                        <div class="col-4 mins"><h3 id="mins">26</h3><p>Mins</p></div>

                                        <div class="col-4 secs"><h3 id="secs">05</h3><p>Secs</p></div>

                                    </div>

                                </div>

                                <div class="col-md-3 col-3 order-3 order-md-3 prize-table text-right">

                                    <div class="prize-button play-button">

                                        <a href="#"><img class="changeimage playimage" src="assets/logos/play-button.svg" alt=""></a>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
                    <div class="col-12 col-md-6 order-md-4 order-6">

                        <div class="row work-part leaderboard-work post-section">

                            <div class="col-6">

                                <h4>{{__('message.entry-post')}}</h4>

                            </div>
                            <div class="col-6 text-right mb-3">
                                <div class="how-it-works" data-toggle="modal" data-target="#gamerule1">
                                        <a href="#"><button type="link">{{__('message.how-it-works')}}</button></a>
                                </div>
                            </div>

                            <div class="col-12 iframe-box position-relative">

                                <div id="myCarousel" class="carousel slide" data-ride="carousel">

                                    <!-- Indicators -->

                                    <div class="carousel-inner">



                                                <div class="carousel-item active">

                                                  <?php echo $leaderboard->media; ?>

                                                </div>


                                    </div>



                                </div>





                            </div>

                            <div class="how-it-works tag-friends">
                                
                                    <a href="{{$leaderboard->post_url}}"><button type="link">{{__('message.tag-friends-now')}}</button></a>
                                

                            </div>

                        </div>

                    </div>

                    <div class="col-12 col-md-6 order-md-7 order-5 leaderboard-spacing mobile-leaderboard">

                        <div class="leaderboard-bar">

                        <h3>{{__('message.top-100')}}</h3>

                        </div>

                        <div class="show-table rotate-image" >

                            <img src="assets/logos/Group 88.svg" alt="">

                        </div>
                    <div class="col-12 col-md-6 order-md-6 order-5 leaderboard-container position-relative" id="mytable">

                        <div class="user-tbl">

                            <div class="row leaderboard-bar-table  table-title-bar m-0">

                                <div class="col-2">

                                    <div class="prize">

                                        <h4>Position</h4>

                                    </div>

                                </div>

                                <div class="col-3">

                                    <div class="name">

                                        <h4>Username</h4>

                                    </div>

                                </div>

                                <div class="col-7 text-right">

                                    <div class="points">

                                        <h4>Mentions</h4>

                                    </div>

                                </div>

                            </div>

                            <div class="leaderboard-table" id="leaderboard-table">

                                @if(!empty($leaderboard->post_mentions))

                                    <?php
                                    /**dark-orange => orange **/
                                    /**light-bg => green **/
                                    $color_array = array('light-bg', 'dark-orange', 'dark-red');
                                    $k = count($color_array);
                                    $i=0;
                                    $p=1;
                                    $FinalMentions=$leaderboard->post_mentions;
                                    $class='dark-red';
                                    ?>



                                    @foreach($FinalMentions as $Mentions)

                                        <?php
                                            if($p>=1 && $p<=3){
                                                $class='light-bg';
                                            }elseif ($p>=4 && $p<=10){
                                                $class='dark-orange';
                                            }else{
                                                $class='dark-red';
                                            }
                                    //  $class= $color_array[$i % $k];

                                        ?>

                                        <div class="row leaderboard-details mentions-row {{$class}} m-0 data-row ownerId_{{$Mentions->ownerId}}"  data-username="{{$Mentions->ownername}}" data-mention="{{$Mentions->totalMentiones}}" >

                                            <div class="col-1">

                                                <div class="prize">

                                                <h4><span class="poition-no">{{$p}}</span>
                                                                                </h4>

                                                </div>

                                            </div>
                                            <div class="col-1">
                                                    <img src="{{$Mentions->ownerflag}}" alt="" style="width: 20px;height: 20px;border-radius:50px">
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
     <div class="col-12 col-md-12 order-md-5 order-7 leaderboard-container skip-to-me-desktop-section">
        <div class="row leaderboard-search user-search">
            <div class="col-sm-12">
            </div>
        </div>
    </div>
    <div class="col-12 col-md-12">
          <div class="row">
            <div class="col-6 col-sm-6  d-none d-md-none">
                <div class="how-it-works see-post"> <button>{{__('message.see-post')}}</button></div>
            </div>
            <div class="col-12 col-sm-12 d-flex pt-2 pb-2 playing" style="justify-content: flex-end;">
            <div class="how-it-works d-none d-md-none d-sm-block d-block playings">

                        <a href="#" class="see-post"> <button type="link">{{__('message.continue-playing')}}</button></a>

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

    @endif

    <div class="modal fade" id="gamerule1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered" role="document">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="gamerule modal-title" id="exampleModalLongTitle">{{__('message.how-it-works')}}</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span>

                    </button>

                </div>

                <div class="modal-body">

                   <?php echo $leaderboard->how_it_works;?>

                </div>



            </div>

        </div>

    </div>

    <script   type="text/javascript">



        if($("#active-leaderboad-single").val()!=''){

            var id=$("#active-leaderboad-single").val();

            var countDownDate=$("#user_leaderboard").attr("data-endtime");
            var countStartDownDate=$("#user_leaderboard").attr("data-starttime");
            ManageCounter(true,countDownDate,countStartDownDate);

        }

        var intervalID = null;

        function ManageCounter(flag,countDownDate,countStartDownDate){

            // Set the date we're counting down to
                console.info(countDownDate);


            var countDownDate = new Date(countDownDate).getTime();
            var countStartDownDate = new Date(countStartDownDate).getTime();
            console.info(countDownDate);
            // Update the count down every 1 second
            if(flag){

                intervalID = setInterval(function() {

                    // Get today's date and time

                    var now = new Date().getTime();

                    // Find the distance between now and the count down date

                    countDownDate=countDownDate - 1000;
                    var  distance = countDownDate - countStartDownDate;

                    // Time calculations for days, hours, minutes and seconds

                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));

                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));

                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));

                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    // Output the result in an element with id="demo"

                    var leaderboard_post_wrapper=$("#user_leaderboard");

                    leaderboard_post_wrapper.find("#days").text(days);

                    leaderboard_post_wrapper.find("#hours").text(hours);

                    leaderboard_post_wrapper.find("#mins").text(minutes);

                    leaderboard_post_wrapper.find("#secs").text(seconds);

                    /*document.getElementById("demo").innerHTML = days + "d " + hours + "h "

                    + minutes + "m " + seconds + "s ";*/

                    // If the count down is over, write some text

                    if (distance < 0) {

                        clearInterval(intervalID);

                        document.getElementById("demo").innerHTML = "EXPIRED";

                    }

                }, 1000);

            }

        }

    </script>

    <script>

        $(document).ready(function(){
            $(".changeimage").click(function(){
                if($(this).hasClass('playimage')){
                    $(this).attr("src", "assets/logos/pause-button.svg");
                    $(this).removeClass('playimage');
                    $(this).addClass('pauseimage');
                }else{
                    $(this).attr("src", "assets/logos/play-button.svg");
                    $(this).removeClass('pauseimage');
                    $(this).addClass('playimage');
                }
            });    
        });

        $(".show-table").click(function(e){
            e.preventDefault();
            if($("#mytable").hasClass("d-none")){
                $("#mytable").removeClass("d-none");
                $(".buyer-header").addClass("d-none");
                $(this).removeClass('rotate-image-360');
                $(this).addClass('rotate-image');
                $(".work-part").addClass('post-section');
            }else{
                $("#mytable").addClass("d-none");
                $(this).removeClass('rotate-image');
                $(this).addClass('rotate-image-360');
                $(".work-part").removeClass('post-section');
                $(".buyer-header").removeClass("d-none");
            }
                });

$(".see-post").click(function(e){
            e.preventDefault();

            if($( window ).width()<=767){
                if($("#mytable").hasClass("d-none")){
                $("#mytable").removeClass("d-none");
                $(".show-table").removeClass('rotate-image-360');
               $(".show-table").addClass('rotate-image');
                $(".work-part").addClass('post-section');
            }else{
                $("#mytable").addClass("d-none");
                $(".work-part").removeClass('post-section');
                $(".show-table").removeClass('rotate-image');
               $(".show-table").addClass('rotate-image-360');
            }
            }else{
                 $('html, body').animate({
        scrollTop: $(".post-section").offset().top
    }, 2000);
            }

                });


        $(".skip-to-me").click(function() {
    $('html, body').animate({
        scrollTop: $(".ownerId_"+$("#instagramid").val()).offset().top
    }, 2000);
});

    </script>

@endsection
@section('title')
The Leaderboard - Live Leaderboard
@endsection
@section('description')
Tag your friends to earn points. Points equals prizes.
@endsection