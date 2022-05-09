<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Configuration;
use Illuminate\Support\Facades\Http;
use App\Models\User;

class ConfigurationController extends Controller
{
    public function index()
    {
        $other = Configuration::where("status",0)->orderBy("created_at","desc")->first();
        if(is_null($other)){
            $other = Configuration::where("is_used",1)->orderBy("created_at","desc")->first();
        }
        $activeRow = Configuration::where("is_used",1)->first();
        $approvalUser = User::where("_id",$activeRow->approval_acc)->first();

        $config = Http::get(env("API_PARTNER").'/v1/config/');
        $response = $config->body();


        return view("vendor.adminlte.configuration.index",["other"=>$other,"approvalUser"=>$approvalUser])->with('config',json_decode($response)->data);
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
        if(isset($request->id)){
            // $response = Http::put(env("API_PARTNER").'/v1/config/',$request->status);
            $config = new Configuration;
            $config->name = "configuration";
            $config->department = $request->department;
            $config->center = $request->center;
            $config->division = $request->division;
            $config->approval_acc = $request->approval_acc;
            $config->sms_otp = $request->sms_otp;
            $config->email_otp = $request->email_otp;
            $config->auditlog_eap = $request->auditlog_eap;
            $config->auditlog_bnpl = $request->auditlog_bnpl;
            $config->status = 0;//waiting for approval
            $config->is_used = 0;//apply
            $config->save();
        }
        return redirect()->route("configuration.index")->with('Update config successfully');
    }

    public function approvalStatus(Request $request){
        if(isset($request->id)){
            $config = Configuration::where("is_used",1)->get();
            foreach($config as $item){
                $item->is_used = 0;
                $item->save();
            }
            $newApproval = Configuration::where("_id",$request->id)->first();
            $newApproval->is_used = 1;
            $newApproval->status = 1;
            if($newApproval->save()){
                return redirect()->route("configuration.index")->with('Approval config successfully');
            }
        }
        
    }

    public function rejectStatus(Request $request){
        if(isset($request->id)){
            $newApproval = Configuration::where("_id",$request->id)->first();
            $newApproval->status = -1;
            if($newApproval->save()){
                return true;
            }
        }
        return false;
    }
}
