<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Lazada;


class LazadaController extends Controller
{
    //
    public function __construct()
    {

    }
    public function checkbnpl(Request $request){
        
        
        if(isset($request->phone)){
            $lazada = Lazada::where("phone",$request->phone);
            $data["code"] = 200;
            $data["result"] = $lazada->get();
            return response($data);
        }else{
            $data["code"] = 200;
            $data["message"] = "no params";
            return response($data);
        }

    }

    public function addLazada(Request $request){
        $lazada = new Lazada;
        $lazada->phone = $request->phone;
        $lazada->name = $request->name;

        return response($lazada->save());

    }
}
