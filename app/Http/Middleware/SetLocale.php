<?php

namespace App\Http\Middleware;

use Closure;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $locale='en';
        if(!isset($_COOKIE['locale'])) {
            $this->setCurrentlanguage();
            app()->setLocale($request->segment(1));
        }else{
            if(isset($_COOKIE['locale'])) {
                if(in_array($_COOKIE['locale'], array("en", "pt", "es", "gr","al","fr"))){
                    if($_COOKIE['locale']==$request->segment(1) ){
                        app()->setLocale($_COOKIE['locale']);
                    }else{
                        app()->setLocale($request->segment(1));
                        setcookie("locale",$request->segment(1),0, "/");
                    }


                }
            }
        }
        return $next($request);
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
                if($ip_data->country_name=='Greece'){
                    $locale='gr';
                }
                if($ip_data->country_name=='Portugal'){
                    $locale='pt';

                }
                if($ip_data->country_name=='Spain'){
                    $locale='es';
                }
                if($ip_data->country_name=='Albania'){
                    $locale='al';
                }
                if($ip_data->country_name=='France'){
                    $locale='fr';
                }

            }
            setcookie("locale", $locale,0, "/");

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
