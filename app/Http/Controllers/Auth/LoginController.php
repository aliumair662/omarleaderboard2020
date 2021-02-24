<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
   // protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->setCurrentlanguage();
        $this->middleware('guest')->except('logout');
    }



    public function showLoginForm()
    {
         
        
        $leaderboard=DB::table('leaderboard')
            ->where('active',1)
            ->first();
        if(!empty($leaderboard)){
            $uniqueleaderboardleaderboardmentions=DB::table('leaderboard_unique_mentiones')
                ->select('ownerId', DB::raw('count(*) as totalMentiones'))
                ->where('leaderboard_id',$leaderboard->id)
                ->groupBy('ownerId')
                ->orderBy('totalMentiones', 'DESC')
                ->limit(10)
                ->get();
            $leaderboardleaderboardmentions=array();
            if(!empty($uniqueleaderboardleaderboardmentions)){
                foreach ($uniqueleaderboardleaderboardmentions as $leaderboardmentions){
                    $owner=DB::table('leaderboard_unique_mentiones')
                        ->where('ownerId',$leaderboardmentions->ownerId)
                        ->first();
                    $leaderboardmentions->ownername=$owner->ownername;
                    $leaderboardmentions->ownername_profile_pic_url=$owner->ownername_profile_pic_url;
                    $leaderboardleaderboardmentions[]=$leaderboardmentions;

                }
                $leaderboard->post_mentions=$leaderboardleaderboardmentions;
            }
        }
        return view('auth/login',array('leaderboard'=>$leaderboard,'title'=>'The Leaderboard - Log in to your account'));
    }
    public function setCurrentlanguage(){
        $url='https://api.ipdata.co/'.$this->getuserIp().'?api-key=b487dc217e511dff46f3a90f5cba8943076d65d97fe3a792f8aa07d7';
        $ip_data=array();
        try {
            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",

            ]);
            $ip_data = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            if ($err) {
            }else{
                $ip_data=json_decode($ip_data);

            }
        } catch (\Exception $e) {

        }
        if(isset($ip_data->message)){
            $ip_data=array();
        }
        $locale='en';
        if(!empty($ip_data)){
            if($ip_data->country_name=='Portugal'){
                $locale='pt';

            }
            if($ip_data->country_name=='Spain'){
                $locale='es';
            }
            if($ip_data->country_name=='Greece'){
                $locale='gr';
            }

        }
        App::setLocale($locale);

    }
    public function getuserIp(){
        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
            $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        }
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];

        if(filter_var($client, FILTER_VALIDATE_IP)){
            $clientIp = $client;
        }
        elseif(filter_var($forward, FILTER_VALIDATE_IP)){
            $clientIp = $forward;
        }
        else{
            $clientIp = $remote;
        }

        return  $clientIp;
    }
}
