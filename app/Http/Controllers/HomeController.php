<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Phpfastcache\Helper\Psr16Adapter;
//use App\Http\Controllers\GeoLocationController;
use App;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function loginInstagram(){
        $instagram = \InstagramScraper\Instagram::withCredentials(new \GuzzleHttp\Client(), 'chumairalidhillon', 'itsaccountings', new Psr16Adapter('Files'));
        $instagram->setUserAgent('User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:78.0) Gecko/20100101 Firefox/78.0');
        $result=$instagram->login();
        $instagram->saveSession();
        $sessionid='';
        $csrftoken='';
        $Allcookie=explode(';',$result['cookie']);
        $session=array();
        $csrftokendata=explode('=',$Allcookie[1]);
        $sessiondata=explode('=',$Allcookie[4]);
        $session=array(
            'sessionid'=>$sessiondata[1],
            'csrftoken'=>$csrftokendata[1]
        );

        DB::table('instagram_session')->where('id',1)->update($session);
        return  DB::getPdo()->lastInsertId();
    }

    /**
     * Get User Instagram name and id.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function instagram()
    {
        //$this->middleware('auth');
        return view('instagram');
    }
    public function addinstagram(Request $request)
    {
       
        $instagramUsername='';
        $instagramid='';
        if($request->instagramUsername!=''){
                $instagramUsername=$request->instagramUsername;
                $update=DB::table('users')
                    ->where('id',Auth::id())
                    ->update(array('instagramUsername' =>$instagramUsername,
                    ));
                return redirect('/'.app()->getLocale().'/home');

        }else{
            return back()->with('error', 'Please add instagram Username !');
        }
    }



    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

       $noinstagram=DB::table('users')
            ->where('id',Auth::id())
            ->whereNull('instagramUsername')->first();
            if(!empty($noinstagram)){
                return redirect(route('instagram',app()->getLocale()));
            }
        $leaderboard=DB::table('leaderboard')
            ->where('active',1)
            ->first();

        if(empty($leaderboard)){
            return redirect(route('noLeaderboard',app()->getLocale()));
        }
        if(!empty($leaderboard)){

          $t1 = Carbon::parse(Carbon::createFromTimestamp($leaderboard->endtime)
                ->format('Y-m-d H:i:s'));
            $t2 =  Carbon::parse(Carbon::createFromTimestamp($leaderboard->starttime)
                ->format('Y-m-d H:i:s'));
            $diff = $t1->diff($t2);
            $leaderboard->days=$diff->d;
            $leaderboard->hours=$diff->h;
            $leaderboard->mins=$diff->m;
            $leaderboard->secs=$diff->s;
            /*$leaderboardleaderboardmentions=DB::table('leaderboardmentions')
                ->where('leaderboard_id',$leaderboard->id)
                ->orderBy('totalMentiones', 'DESC')
                ->limit(100)
                ->get();*/
            $uniqueleaderboardleaderboardmentions=DB::table('leaderboard_unique_mentiones')
                ->select('ownerId', DB::raw('count(*) as totalMentiones'))
                ->where('leaderboard_id',$leaderboard->id)
                ->groupBy('ownerId')
                ->orderBy('totalMentiones', 'DESC')
                ->limit(100)
                ->get();
            $leaderboardleaderboardmentions=array();
            if(!empty($uniqueleaderboardleaderboardmentions)){
                foreach ($uniqueleaderboardleaderboardmentions as $leaderboardmentions){
                    $owner=DB::table('leaderboard_unique_mentiones')
                        ->where('ownerId',$leaderboardmentions->ownerId)
                        ->first();
                        $user=DB::table('users')
                        ->where('instagramid',$leaderboardmentions->ownerId)
                        ->first();
                    $leaderboardmentions->ownerflag=url("/assets/logos/annony.svg");
                    if(!empty($user)){
                        $leaderboardmentions->ownerflag=($user->flag != '') ? $user->flag : url("/assets/logos/annony.svg");
                        if($user->country=='Kosovo'){
                            $leaderboardmentions->ownerflag=url("/assets/logos/kosovo.svg");
                        }

                    }
                    $leaderboardmentions->ownername=$owner->ownername;
                    $leaderboardmentions->ownername_profile_pic_url=$owner->ownername_profile_pic_url;
                    $leaderboardleaderboardmentions[]=$leaderboardmentions;
                }

            }

            $leaderboard->myposition='';
            $leaderboard->totalposition='';
            $leaderboard->topermentiones='';
            $leaderboard->mymentiones='';
            $leaderboard->awaymessage='';
            $leaderboard->post_mentions=array();
            $awaymentiones='';
            if(!empty($leaderboardleaderboardmentions)){
                $leaderboard->post_mentions=$leaderboardleaderboardmentions;
                $leaderboard->topermentiones=$leaderboardleaderboardmentions[0]->totalMentiones;

                $Scores=DB::table('leaderboard_unique_mentiones')
                    ->select('ownerId', DB::raw('count(*) as totalMentiones'))
                    ->where('leaderboard_id',$leaderboard->id)
                    ->groupBy('ownerId')
                    ->orderBy('totalMentiones', 'DESC')
                    /*->limit(100)->pluck('ownerId')->toArray();*/
                    ->pluck('ownerId')->toArray();

               /* $Scores= DB::table('leaderboard_unique_mentiones')
                    ->orderBy('totalMentiones', 'desc')
                    ->where('leaderboard_id',$leaderboard->id)
                    ->pluck('ownerId')->toArray();*/
                $Allranking=array_flip($Scores);
                if(array_key_exists(Auth::user()->instagramid,$Allranking)){
                    $leaderboard->myposition=$Allranking[Auth::user()->instagramid] +1;
                    $leaderboard->myposition=$this->ordinal($leaderboard->myposition);
                    $mymentions= DB::table('leaderboard_unique_mentiones')
                        ->where('leaderboard_id',$leaderboard->id)
                        ->where('ownerId',Auth::user()->instagramid)->count();
                    $leaderboard->mymentiones= $mymentions;
                    if($mymentions >0){
                        $awaymentiones= $leaderboard->topermentiones - $mymentions;
                    }else{
                        $awaymentiones= $leaderboard->topermentiones - 0;
                    }
                }else{
                    $awaymentiones=$leaderboardleaderboardmentions[0]->totalMentiones;
                }

                $leaderboard->awaymessage=__('message.you-are').' '.$awaymentiones.' '.__('message.mentions-away-from-position'). ' 1.';

            }
            $leaderboard->leaderboard_end_date =Carbon::createFromTimestamp($leaderboard->endtime)
                ->format('Y/m/d H:i:s');
            $leaderboard->leaderboard_start_date =Carbon::createFromTimestamp($leaderboard->starttime)
                ->format('Y/m/d H:i:s');
            $media='';
            if($leaderboard->media_type=='image'){
                $media='<img  src="'.$leaderboard->media_url.'">';
            }else{
                $media='<video width="320" height="240" controls>';
                $media.='<source src="movie.ogg" type="video/ogg">';
                $media.='</video>';
            }
            $leaderboard->media=$media;
            $leaderboard->totalposition=DB::table('leaderboard_unique_mentiones')
                ->select('ownerId', DB::raw('count(*) as totalMentiones'))
                ->where('leaderboard_id',$leaderboard->id)
                ->groupBy('ownerId')
                ->orderBy('totalMentiones', 'DESC')->get();
            $leaderboard->totalposition=count($leaderboard->totalposition);
        }
        return view('home',array('leaderboard'=>$leaderboard));
    }

    function noLeaderboard(){
        return view('leaderboard/noleaderboard');
    }
    public function latestMentionBoard(Request $request)
    {
        $leaderboard=DB::table('leaderboard')
            ->where('id',$request->id)
            ->first();
        if(!empty($leaderboard)){
            /*$leaderboardleaderboardmentions=DB::table('leaderboardmentions')
                ->where('leaderboard_id',$leaderboard->id)
                ->orderBy('ownername', 'ASC')
                ->get();*/
            /*$leaderboardleaderboardmentions=DB::table('leaderboardmentions')
                ->where('leaderboard_id',$leaderboard->id)
                ->orderBy('totalMentiones', 'DESC')
                ->limit(100)
                ->get();
            if(!empty($leaderboardleaderboardmentions)){
                $leaderboard->post_mentions=$leaderboardleaderboardmentions;
            }*/


            $uniqueleaderboardleaderboardmentions=DB::table('leaderboard_unique_mentiones')
                ->select('ownerId', DB::raw('count(*) as totalMentiones'))
                ->where('leaderboard_id',$leaderboard->id)
                ->groupBy('ownerId')
                ->orderBy('totalMentiones', 'DESC')
                ->limit(100)
                ->get();
            $leaderboardleaderboardmentions=array();
            if(!empty($uniqueleaderboardleaderboardmentions)){
                foreach ($uniqueleaderboardleaderboardmentions as $leaderboardmentions){
                    $owner=DB::table('leaderboard_unique_mentiones')
                        ->where('ownerId',$leaderboardmentions->ownerId)
                        ->first();
                        $user=DB::table('users')
                        ->where('instagramid',$leaderboardmentions->ownerId)
                        ->first();
                    $leaderboardmentions->ownerflag=url("/assets/logos/annony.svg");
                    if(!empty($user)){
                        $leaderboardmentions->ownerflag=($user->flag != '') ? $user->flag : url("/assets/logos/annony.svg");
                        if($user->country=='Kosovo'){
                            $leaderboardmentions->ownerflag=url("/assets/logos/kosovo.svg");
                        }
                    }
                    $leaderboardmentions->ownername=$owner->ownername;
                    $leaderboardmentions->ownername_profile_pic_url=$owner->ownername_profile_pic_url;
                    $leaderboardleaderboardmentions[]=$leaderboardmentions;
                }

            }

        }
        if(!empty($leaderboardleaderboardmentions)){
            $leaderboard->post_mentions=$leaderboardleaderboardmentions;
        }
        if(!empty($leaderboard->post_mentions)){
            $myposition='';
            $totalposition='';
            $mymentiones='';
            $awaymessage='';

            if(!empty($leaderboardleaderboardmentions)){
                $totalposition=DB::table('leaderboard_unique_mentiones')
                    ->select('ownerId', DB::raw('count(*) as totalMentiones'))
                    ->where('leaderboard_id',$leaderboard->id)
                    ->groupBy('ownerId')
                    ->orderBy('totalMentiones', 'DESC')->get();
                $totalposition=count($totalposition);
                $topermentiones=$leaderboardleaderboardmentions[0]->totalMentiones;
                $leaderboard->post_mentions=$leaderboardleaderboardmentions;
                $Scores=DB::table('leaderboard_unique_mentiones')
                    ->select('ownerId', DB::raw('count(*) as totalMentiones'))
                    ->where('leaderboard_id',$leaderboard->id)
                    ->groupBy('ownerId')
                    ->orderBy('totalMentiones', 'DESC')
                    /*->limit(100)->pluck('ownerId')->toArray();*/
                    ->pluck('ownerId')->toArray();
                $Allranking=array_flip($Scores);
                if(array_key_exists(Auth::user()->instagramid,$Allranking)){
                    $myposition=$Allranking[Auth::user()->instagramid]+1;
                    $mymentions=DB::table('leaderboard_unique_mentiones')
                        ->where('leaderboard_id',$leaderboard->id)
                        ->where('ownerId',Auth::user()->instagramid)->count();


                    if($mymentions >0){
                        $mymentiones=$mymentions;
                        $awaymentiones=$topermentiones  - $mymentions;
                    }else{
                        $awaymentiones=$topermentiones;
                    }
                   // $awaymessage='You\'re  '.$awaymentiones.'  mentions away from position 1.';
                    $awaymessage= __('message.you-are').' '.$awaymentiones.' '.__('message.mentions-away-from-position'). ' 1.';
                }else{
                    $awaymentiones=$topermentiones;
                   // $awaymessage='You\'re  '.$awaymentiones.'  mentions away from position 1.';
                    $awaymessage= __('message.you-are').' '. $awaymentiones.' '.__('message.mentions-away-from-position'). ' 1.';
                }
            }
            return response()->json(['mentions'=>$leaderboard->post_mentions,'myposition'=>$myposition,'totalposition'=>$totalposition,'awaymessage'=>$awaymessage,'code'=>200],200);
        }else{
            return response()->json(['html'=>'','code'=>200],404);
        }
    }

    public function ordinal($number) {
        $ends = array('th','st','nd','rd','th','th','th','th','th','th');
        if ((($number % 100) >= 11) && (($number%100) <= 13))
            return $number. 'th';
        else
            return $number. $ends[$number % 10];
    }

 function buytime($locale,$id){
   
    $leaderboard=DB::table('leaderboard')
            ->where('id',$id)->first();
                  $package=array();
            if(!empty($leaderboard)){
            $package=DB::table('leaderboardpackages')
            ->where('id', $leaderboard->package)->first();
            $package->onehour=$package->price_per_hour * 1;
            $package->twohour=$package->price_per_hour * 2;
            $package->threehour=$package->price_per_hour * 3;
            $package->fourhour=$package->price_per_hour * 4;
            }
     

        return view('buytime',array('leaderboard'=>$leaderboard,'package'=> $package));
    }


}
