<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Configuration;
use Illuminate\Support\Facades\Http;

class ConfigurationController extends Controller
{
    public function index()
    {
        // $config = Configuration::all();
        $config = Http::get(env("API_PARTNER").'/v1/config/');
        
        $response = $config->body();
        return view("vendor.adminlte.configuration.index")->with('config',json_decode($response)->data);
    }


    public function create()
    {
        return view('vendor.adminlte.configuration.add');
    }

    public function store(Request $request)
    {
        $config = new Configuration;
        $config->name = $request->Title_Create;
        $config->status = 0;
        $config->save();
        return redirect()->route("configuration.index")->with('Create config successfully');
    }

    public function updateStatus(Request $request)
    {
        if(isset($request->status)){
            $response = Http::put(env("API_PARTNER").'/v1/config/',$request->status);
        }
        return redirect()->route("configuration.index")->with('Update config successfully');
    }
}
