<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use DataTables;
use Mail;
use App\Mail\EmailTemplate;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Jobs\SendEmailJob;
use Carbon\Carbon;
use function PHPUnit\Framework\isNull;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\Auth\ApiRequest;


class CustomerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function login(Request $request)
    {
        
    }

    public function __construct()
    {
         $this->middleware('auth');
         return ;
    }

    public function mailTemplate()
    {
        dispatch(new SendEmailJob());
        //Mail::to($myEmail)->send(new EmailTemplate($details));
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {   
        return view('vendor.adminlte.customers.customer');
    }

    public function create()
    {
        return view('vendor.adminlte.customers.add');
    }

    
    public function store(Request $request )
    {
        $customer = new Customer;
        $customer->username = $request->username;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $result = $customer->save();
        if($result == 1)
        {
            $this->mailTemplate($request);
            return redirect()->route("customer")->with('add','Create news successfully');
            // return redirect()->route("customer");
        }
    }

    public function show($id=null,$bnpl_id=null){
        $ApiRequest = new ApiRequest;
        $data_eap = $ApiRequest->refreshTokenResponse(env("API_PARTNER").'/v1/admin/getUserEAP/'.$id);
        $data = $data_eap->json();
        $status =$data["status"];
        if($data_eap->status() === 200)
        {
            $dt = Carbon::now();
            $day = $dt->toDateString();
            $newDateTime = $dt->subDays(30);
            $newDateTime = $newDateTime->toDateString();
            $eap = $data_eap->json();
            $cus = $eap["data"];
            $phone = $cus["phone"];
            if($bnpl_id !== null){
                $bnpl = $ApiRequest->refreshTokenResponse(env("API_PARTNER").'/v1/admin/getUserBNPL/'.$bnpl_id);
                $data = $bnpl->json();
                $bnpl_info = $data["data"];
            }
            else
            {
                $params = array();
                $params["phone"] = $phone;
                $params["from"] = $newDateTime;
                $params["to"] = $day;

                $response = $ApiRequest->refreshTokenResponse(env("API_PARTNER").'/v1/admin/search',$params);
                $response = $response->json();
                $bnpl = $response["data"]["BNPL"];
                if(!empty($bnpl))
                {
                    $bnpl_info = $bnpl[0];
                }
                else
                {
                    $bnpl_info ="";
                }
                
            }
        }
        else
        {
            $cus = "";
            $data_bnpl = $ApiRequest->refreshTokenResponse(env("API_PARTNER").'/v1/admin/getUserBNPL/'.$id);
            $data = $data_bnpl->json();
            $bnpl_info = $data["data"];
        }
        $user = Auth::user();
        $roles = new Role;
        $permissions = new Permission;
        $check_permission=[];

        $role = Role::find($user->role_ids[0]);
        $check_role = $role->permission_ids;
        for($i=0;$i < count($check_role); $i++)
        {
            if(empty($check_role[$i]))
            {
                $user->permission = "";
            }
            else
            {
                $permission = $permissions->find($check_role[$i]);
                $check_permission[$i]=$permission->name;
            }
        }
        $eap_check= in_array('customers-view-eap', $check_permission);
        $bnpl_check = in_array('customers-view-bnpl', $check_permission);
		return view('vendor.adminlte.customers.show',['cus'=>$cus ,'check_permission'=>$check_permission,'eap_check'=>$eap_check ,'bnpl_check'=> $bnpl_check,'bnpl_info'=>$bnpl_info]);
    }

    public function destroy(Request $request )
    {
        $ApiRequest = new ApiRequest;
        $response = $ApiRequest->deleteResponse(env("API_PARTNER").'/v1/admin/deleteSoftEAP/'.$request->id);
        return $response;
    }

    public function dtajax(Request $request){
        $ApiRequest = new ApiRequest;
        if ($request->ajax()) {
            $array = [];
            $strFilter = "";
            if(!empty($request->filter) && $request->filter["from"] !== NULL)
            {
                
                $response = $ApiRequest->refreshTokenResponse(env("API_PARTNER").'/v1/admin/search/',$request->filter);
                

                if($response->status() != 200){
                    return $response->body();
                }

                $result = $response->json();
                $bnpl = $result["data"]["BNPL"];
                $eap = $result["data"]["EAP"];

                if($eap !=null && $bnpl == null)
                {
                    // $eap[0]["bnpl"] = $result["data"]["BNPL"];
                    $out =  Datatables::of($eap)->make(true);
                    $data = $out->getData();   
                    
                    for($i=0; $i < count($data->data); $i++) {
                        $output = '';
                        $output .= ' <a href="'.url(route('customer.show',['id'=>$data->data[$i]->_id])).'#eap_info" class="btn btn-info btn-xs" data-toggle="tooltip" title="Show Details"  style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-eye"></i></a>';
                        $output .= ' <button class="btn btn-danger btn-xs btnDelete" style="display:inline;padding:2px 5px 3px 5px;height:22px;width:25.5px" onclick="delete1($(this))" type="button" title="Delete User"  data-id="'.$data->data[$i]->_id.'"><i class="fa fa-times"></i></button>';
                        $data->data[$i]->action = (string)$output;
                        //config link for phonenumber
                        $data->data[$i]->urlphone = '<a href="'.url(route('customer.show',['id'=>$data->data[$i]->_id])).'#eap_info" > '.$data->data[$i]->phone.' </a>';

                    }
                    $out->setData($data);
                    return $out;
                }
                // print_r($bnpl);exit;
                if($eap !=null && $bnpl != null)
                {
                    $out =  Datatables::of($eap)->make(true);
                    $data = $out->getData();   
                    
                    for($i=0; $i < count($data->data); $i++) {
                        $output = '';
                        $output .= ' <a href="'.url(route('customer.show',['id'=>$data->data[$i]->_id])).'#eap_info" class="btn btn-info btn-xs" data-toggle="tooltip" title="Show Details" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-eye"></i></a>';
                        $output .= ' <button class="btn btn-danger btn-xs btnDelete" style="display:inline;padding:2px 5px 3px 5px;height:22px;width:25.5px" onclick="delete1($(this))" type="button" title="Delete User"  data-id="'.$data->data[$i]->_id.'"><i class="fa fa-times"></i></button>';
                        $data->data[$i]->action = (string)$output;
                        $data->data[$i]->urlphone = '<a href="'.url(route('customer.show2',['id'=>$data->data[$i]->_id,'bnpl'=>$bnpl[0]["_id"]])).'#eap_info" > '.$data->data[$i]->phone.' </a>';
                    }
                    $out->setData($data);
                    return $out;
                }
                if($eap ==null && $bnpl != null)
                {
                    $eap = $result["data"]["BNPL"];
                    $eap[0]["bnpl"] = $result["data"]["BNPL"];
                    $out =  Datatables::of($eap)->make(true);
                    $data = $out->getData();   

                    for($i=0; $i < count($data->data); $i++) {
                        $output = '';
                        $output .= ' <a href="'.url(route('customer.show',['id'=>$data->data[$i]->_id])).'#bnpl_info" class="btn btn-info btn-xs" data-toggle="tooltip" title="Show Details" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-eye"></i></a>';
                        $output .= ' <button class="btn btn-danger btn-xs btnDelete" style="display:inline;padding:2px 5px 3px 5px;height:22px;width:25.5px" onclick="delete1(this)" type="button" title="Delete User"  data-id="'.$data->data[$i]->_id.'"><i class="fa fa-times"></i></button>';
                        $data->data[$i]->action = (string)$output;

                        //config link for phonenumber
                        $data->data[$i]->urlphone = '<a href="'.url(route('customer.show',['id'=>$data->data[$i]->_id])).'#bnpl_info" > '.$data->data[$i]->phone.' </a>';

                    }
                    $out->setData($data);
                    return $out;
                }
                $out =  Datatables::of([])->make(true);
                return $out;
                
            }
            else
            {
                $result["data"] = [];
                $out =  Datatables::of([])->make(false);
                return $out;      
            }
            
        }
    }


    
}
