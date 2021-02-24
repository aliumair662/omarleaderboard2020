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

}
