<?php

namespace App\Http\Requests\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiRequest 
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    private function _login(){

        $user = "tiki";
        $pass = "12345678";
        $strApp = "appKey=113911Liverpool&appId=112233445566778899";

        session(['apiToken' => null]);
        session(['apiRefreshToken' => null]);
        $res = Http::post(env("API_PARTNER").'/v1/admin/login?'.$strApp,["username"=>$user, "password" => $pass]);
        if($res->status() === 200){
            try{
                    $data = $res->json();
                    session(['apiToken' => $data["token"]]);
                    session(['apiRefreshToken' => $data["data"]["refreshToken"]]);
            }
            catch(e){
                return false;
            }
        }else{
            print_r($res->body());
            exit;
        }
        return true;
    }

    public function refreshTokenResponse($url,$req = array()){

        $req["appKey"] = "113911Liverpool";
        $req["appId"] = "112233445566778899";

        //get token
        if(session("apiToken") === null || session("apiToken") === ''){
            $this->_login();
        }

        //refresh token and response data
        $response = Http::withToken(session("apiToken"))->get($url,$req);
        if($response->status() != 200){
            $this->_refreshToken();
            $response = Http::withToken(session("apiToken"))->get($url,$req);
        }
        
        return $response;

    }

    private function _refreshToken(){

        $strApp = "appKey=113911Liverpool&appId=112233445566778899";
        $url = env("API_PARTNER").'/v1/admin/requestRefreshToken?'.$strApp;
        $req = [
            "refreshToken" => session("apiRefreshToken")
        ];

        $res = Http::withToken(session("apiToken"))->put($url,$req);
        if($res->status() === 200){
            $data = $res->json();
            session(['apiToken' => $data["accessToken"]]);
            session(['apiRefreshToken' => $data["refreshToken"]]);
        }elseif($res->status() >= 400){
            $this->_login();
        }
        return true;

    }

    
}
