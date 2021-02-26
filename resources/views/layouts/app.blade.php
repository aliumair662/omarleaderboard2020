<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description')">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
   

    <!-- Scripts -->
    <link rel="icon" href="{{ asset('assets/logos/favicongame.svg') }}" type="image/svg" sizes="16x16">
    <!-- Fonts -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" type="text/css" href="{{ asset('style.css') }}">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Droid+Sans:400,700">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    
    <!-- Google Tag Manager -->

<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':

new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],

j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=

'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);

})(window,document,'script','dataLayer','GTM-TN3SJHQ');</script>

<!-- End Google Tag Manager -->
</head>
<body>

    <!-- Google Tag Manager (noscript) -->

<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TN3SJHQ"

height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

<!-- End Google Tag Manager (noscript) -->
    <div id="app">
        <header>
            <div class="container-fluid site-wrapper">
                <div class="row header-row">
                    <div class="col-12 text-center">
                        <img src="{{ asset('assets/logos/logo.png') }}" height="40">
                    </div>
                </div>
            </div>

        </header>

        <main>
            @yield('content')
        </main>
        <footer>
          <div class="container-fluid site-wrapper">
                <div class="row">
                    <div class="col-12 text-center">
                       <p>©️ 2021 The Leaderboard</p>
                    </div>
                    <div class="col-12 text-center d-flex justify-content-center mt-2 mb-2">
                        <div class="dropdown">
                        <button class="dropbtn">
                            <?php echo  (app()->getLocale() == 'gr') ? '<img src='.asset("assets/logos/Greece.svg").' width="20" height="15"> Greek' : '' ?>
                            <?php echo  (app()->getLocale() == 'pt') ? '<img src='.asset("assets/logos/Portugal.svg").' width="20" height="15"> Portuguese' : '' ?>
                            <?php echo  (app()->getLocale() == 'es') ? '<img src='.asset("assets/logos/Spain.svg").' width="20" height="15"> Spanish' : '' ?>
                            <?php echo  (app()->getLocale() == 'en') ? '<img src='.asset("assets/logos/United-Kingdom.svg").' width="20" height="15"> English' : '' ?>
                            <?php echo  (app()->getLocale() == 'al') ? '<img src='.asset("assets/logos/United-Kingdom.svg").' width="20" height="15"> English' : '' ?>
                        </button>

                        <div class="dropdown-content">
                            <a href="{{ route(Route::currentRouteName(),'gr') }}">
                                <img src="{{ asset('assets/logos/Greece.svg') }}" width="20" height="15">Greek</a>
                            <a href="{{ route(Route::currentRouteName(),'pt') }}">
                                <img src="{{ asset('assets/logos/Portugal.svg') }}"width="20" height="15">Portuguese</a>
                            <a href="{{ route(Route::currentRouteName(),'es') }}">
                                <img src="{{ asset('assets/logos/Spain.svg') }}"width="20" height="15">Spanish</a>
                            <a href="{{ route(Route::currentRouteName(),'en') }}">
                                <img src="{{ asset('assets/logos/United-Kingdom.svg') }}"width="20" height="15">English</a>
                            <a href="{{ route(Route::currentRouteName(),'al') }}">
                                <img src="{{ asset('assets/logos/albania.svg') }}"width="20" height="15">Albania</a>
                        </div>
                    </div>
                        <div class="insta-feed ml-3">
                            <a href="https://www.instagram.com/theleaderboard.io/">
                             <i class="fab fa-instagram"></i>
                            </a>
                        </div>


                    </div>
                    <div class="col-12 text-center">
                        <p class="footer-infotext">{{__('message.footer-text')}}</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>


    <!-- CDNS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <!-- CDNS -->

    <script>

        $( document ).ready(function() {
            sortMentionRow();
            if($("#active-leaderboad-single").val()!=''){
                setInterval(function(){ getSinglelatestMentionBoard(); }, 10000);

            }

        });


        function sortMentionRow(){
            var store = [];
            $( ".mentions-row" ).each(function( i ) {
                var sortnr = parseFloat($(this).attr("data-mention"));
                if(!isNaN(sortnr)) store.push([sortnr, $(this)]);
            });
            store.sort(function(x,y){
                // return x[0] - y[0];
                return y[0] - x[0];
            });
            var len=store.length;
            var p=1;
            var colorclass='';
            for(var i=0; i<len; i++){
                if(p>=1 && p<=3){
                    colorclass='light-bg';
                }else if (p>=4 && p<=10){
                    colorclass='dark-orange';
                }else{
                    colorclass='dark-red';
                }
                $(store[i][1]).removeClass('light-bg');
                $(store[i][1]).removeClass('dark-orange');
                $(store[i][1]).removeClass('dark-red');
               $(store[i][1]).addClass(colorclass);
                //console.info(store[i][1]);
                $("#leaderboard-table").append(store[i][1]);
                p++;
            }
            store = null;


            $('.poition-no').each(function(idx, elem){

                $(elem).text(idx+1);
            });
            //whatismyPosition();
        }
        function whatismyPosition(){

            var total_position=$('.mentions-row').length;
            var myposition=0;
            if($('#instagramid').val()!=''){
                console.info('ownerId_'+$('#instagramid').val());
                if($('.mentions-row').hasClass('ownerId_'+$('#instagramid').val())){
                    console.info("my position exit");
                    myposition=$('.ownerId_'+$('#instagramid').val()).find('.poition-no').text();
                    $("#notonlederboard").addClass('d-none');
                    $("#onlederboard").removeClass('d-none');
                    $(".skip-to-me").removeClass('d-none');
                    $("#myposition").text(ordinal_suffix_of(myposition));
                    $("#total-position").text(total_position);
                }else{
                    $("#notonlederboard").removeClass('d-none');
                    $("#onlederboard").addClass('d-none');
                    $(".skip-to-me").addClass('d-none');

                }

            }else{
                $("#notonlederboard").removeClass('d-none');
                $("#onlederboard").addClass('d-none');

            }


        }
        function ordinal_suffix_of(i) {
            var j = i % 10,
                k = i % 100;
            if (j == 1 && k != 11) {
                return i + "st";
            }
            if (j == 2 && k != 12) {
                return i + "nd";
            }
            if (j == 3 && k != 13) {
                return i + "rd";
            }
            return i + "th";
        }
        /*Get Post Updated Data*/
        function getSinglelatestMentionBoard(){
            var route='/public/latestMentionBoard';
            $.ajax({
                url: route,
                type: 'POST',
                data: {
                    'id':$("#active-leaderboad-single").val(),
                    '_token': '{{ csrf_token() }}',
                },
                success: function(response) {
                    if(response.code==200){
                        var Allmentions=response.mentions;
                        var html='';
                        for (var i = 0; i < Allmentions.length; i++) {
                            var mention=Allmentions[i];

                            if($(".mentions-row").hasClass("ownerId_"+mention.ownerId)){
                                $("#total_mentions_"+mention.ownerId).text(mention.totalMentiones);
                                $('.ownerId_'+mention.ownerId).attr('data-mention',mention.totalMentiones);
                            }else{

                                html+='<div class="row leaderboard-details mentions-row m-0 ownerId_'+mention.ownerId+'" data-id="'+mention.ownerId+'" data-mention="'+mention.totalMentiones+'">';
                                html+='<div class="col-1">';
                                html+='<div class="prize">';
                                html+='<h4><span class="poition-no"></span>';
                                html+='</h4>';
                                html+='</div>';
                                html+='</div>';

                                html+='<div class="col-1">';
                                html+='<img src="'+mention.ownerflag+'" alt="" style="width: 20px;height: 20px;border-radius:50px">';
                                html+='</div>';

                                html+='<div class="col-3">';
                                html+='<div class="name">';
                                html+='<div class="account">';
                                html+='<div class="table-avatar">';
                                html+='<img class="mr-2" src="'+mention.ownername_profile_pic_url+'" alt="">';
                                html+='<span><h4>'+mention.ownername+'</h4></span>';
                                html+='</div>';
                                html+='</div>';
                                html+='</div>';
                                html+='</div>';

                                html+='<div class="col-6 text-right">';
                                html+='<div class="points">';
                                html+='<h4 id="total_mentions_'+mention.ownerId+'">'+mention.totalMentiones+'</h4>';
                                html+='</div>';
                                html+='</div>';
                                html+='</div>';

                            }

                        }
                        if(html!=''){
                            $("#leaderboard-table").append(html);
                        }
                        if(response.myposition!=''){
                           var  myposition=response.myposition;
                           var  totalposition=response.totalposition;
                            $("#notonlederboard").addClass('d-none');
                            $("#onlederboard").removeClass('d-none');
                            $(".skip-to-me").removeClass('d-none');
                            $("#myposition").text(ordinal_suffix_of(myposition));
                            $("#total-position").text(totalposition);
                        }else{
                            $("#notonlederboard").removeClass('d-none');
                            $("#onlederboard").addClass('d-none');
                            $(".skip-to-me").addClass('d-none');

                        }
                        if(response.awaymessage!=''){
                            $("#away_message").removeClass('d-none');
                            $("#away_message").find('p').text(response.awaymessage);
                        }else{
                            $("#away_message").find('p').text('');
                            $("#away_message").addClass('d-none');
                        }
                        sortMentionRow();
                    }

                },
            });
        }


        function searchUser() {
            // Declare variables
            var input = document.getElementById("keyword");
            var filter = input.value.toLowerCase();
            var table = document.getElementById("leaderboard-mentions-section");
            var div = table.getElementsByClassName("data-row");
            var filtered=false;
            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < div.length; i++) {
                var username = div[i].getAttribute("data-username");
                console.info(username+"=="+filter);
                if (username.toLowerCase().indexOf(filter) > -1) {
                    filtered = true;
                }
                if(filtered===true) {
                    div[i].style.display = '';
                }
                else {
                    console.info("notmatc");
                    console.info(div[i]);
                    div[i].style.display = 'none';
                }
            }

        }



        </script>
        <script type="text/javascript">
/*function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}*/
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

</body>
</html>
