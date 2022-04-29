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

    public function show($id){
        $data_eap = Http::get(env("API_PARTNER").'/v1/admin/getUserEAP/'.$id);
        if(!empty($data_eap))
        {
            
            $eap = $data_eap->json();
            $cus = $eap["data"];
            $phone = $cus["phone"];
            $response = Http::get(env("API_PARTNER").'/v1/admin/search?phone='.$phone);
            $response = $response->json();
            $bnpl = $response["data"]["BNPL"];
            if(empty($bnpl))
            {
                $bnpl_info = "";
            }
            else
            {
                $bnpl_info = $bnpl[0];
            }
            
                    // print_r($phone);
                    // print_r($bnpl_info);
                    // exit;
        }
        else
        {
            $cus = "";
            $data_bnpl = Http::get(env("API_PARTNER").'/v1/admin/getUserBNPL/'.$id);
            $bnpl = $data_bnpl->json();
            $bnpl_info = $bnpl["data"];
        }
        $user = Auth::user();
                    $roles = new Role;
                    $permissions = new Permission;
                    $check_permission=[];
                    // print_r($user->role_ids[0]);
                    $role = Role::find($user->role_ids[0]);
                    $check_role = $role->permission_ids;
                    for($i=0;$i < count($check_role); $i++)
                    {
                        if(empty($check_role[$i])){
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
        // print_r($phone);
        // $data_bnpl = Http::get(env("API_PARTNER").'/v1/admin/search?phone='.$phone);
        // $bnpl = $data_bnpl->json();
        // $cus_bnpl = $bnpl["data"];
        // // print_r($cus["_id"]);
        // if($cus_bnpl["BNPL"]!=null)
        // {
        //     print_r($cus_bnpl);
        // }
        // else
        // {
        //     print_r("abc");
        // }
		// if(isset($cus["_id"])) {
		// 	$setErrorsBag = "khong hien thi";
			return view('vendor.adminlte.customers.show',['cus'=>$cus ,'check_permission'=>$check_permission,'eap_check'=>$eap_check ,'bnpl_check'=> $bnpl_check,'bnpl_info'=>$bnpl_info]);
		// } 
            // else {
			// 	return view('errors.404', [
			// 		'record_id' => $id,
			// 		'record_name' => ucfirst("cus"),
			// 	]);
			// }
    }

    public function destroy(Request $request )
    {
        $promotion = Customer::find($request->id);
        $promotion->isDelete = 1;
        $promotion->save();
        return redirect()->route('customer')->with('delete','Customers deleted successfull');
    }


    public function dtajax(Request $request){
        if ($request->ajax()) {
            $strFilter = "";
            if(!empty($request->filter))
            {
                foreach($request->filter as $key=>$val){
                    if($val != null){
                        $strFilter .= $key."=".$val."&";
                    }
                }
                
                $strFilter = ($strFilter!="")?"?".$strFilter:"";
                $strFilter = rtrim($strFilter, "&");
                $response = Http::get(env("API_PARTNER").'/v1/admin/search/'.$strFilter);
                $result = $response->json();
                
                if($result["status"] != 1){
                    return [];
                }
                $bnpl = $result["data"]["BNPL"];
                $eap = $result["data"]["EAP"];
                if($eap !=null && $bnpl == null)
                {
                    // $eap[0]["bnpl"] = $result["data"]["BNPL"];
                    $out =  Datatables::of($eap)->make(true);
                    $data = $out->getData();   
                    
                    for($i=0; $i < count($data->data); $i++) {
                        // $name_before = substr($data->data[$i]->email,0,3);
                        // $name_after = substr($data->data[$i]->email,-4,4);
                        // $data->data[$i]->email = $name_before."***@***".$name_after;   
                        // $phone_before = substr($data->data[$i]->phone,0,3);
                        // $phone_after = substr($data->data[$i]->phone,-1,3);
                        // $data->data[$i]->phone = $phone_before."******".$phone_after;
                        $output = '';
                        $output .= ' <a href="'.url(route('customer.show',['id'=>$data->data[$i]->_id])).'#eap_info" class="btn btn-info btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-eye"></i></a>';
                        $output .= ' <a data-toggle="modal" data-target="#demoModal-'.$data->data[$i]->_id.'" data-id="'.$data->data[$i]->_id.'" class="btn btn-danger btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-ban"></i></a>';
                        $output .= ' <button class="btn btn-danger btn-xs btnDelete" onclick="delete1($(this))" type="button" title="click here"  data-id="'.$data->data[$i]->_id.'"><i class="fa fa-times"></i></button>';
                        $data->data[$i]->action = (string)$output;

                        //config link for phonenumber
                        $data->data[$i]->urlphone = '<a href="'.url(route('customer.show',['id'=>$data->data[$i]->_id])).'#eap_info" > '.$data->data[$i]->phone.' </a>';

                    }
                    $out->setData($data);
                    return $out;
                }
                if($eap !=null && $bnpl != null)
                {
                    if(count($eap)==2)
                    {
                        if($eap[0]["_id"]==$eap[1]["_id"])
                        {
                             unset($eap[1]);
                             $eap[0]["bnpl"] = $result["data"]["BNPL"];
                        }
                        else
                        {
                            for ($j=0 ;$j<count($eap);$j++)
                            {
                                $eap[$j]["bnpl"] = $result["data"]["BNPL"];
                            }
                        }
                            
                    }
                    else
                    {
                        for ($j=0 ;$j<count($eap);$j++)
                        {
                            $eap[$j]["bnpl"] = $result["data"]["BNPL"];
                        }
                    }
                    // $test = count($eap[0]["bnpl"]);
                    // foreach($result["data"]["BNPL"] as $key=>$bnpl){
                    //     $eap[$key]["bnpl"] = $bnpl;
                    // } 
                    $out =  Datatables::of($eap)->make(true);
                    $data = $out->getData();   
                    for($i=0; $i < count($data->data); $i++) {
                        $output = '';
                        $name_before = substr($data->data[$i]->email,0,3);
                        $name_after = substr($data->data[$i]->email,-4,4);
                        $data->data[$i]->email = (Auth::user()->can("customers-unmask"))?$data->data[$i]->email:$name_before."***@***".$name_after;   
                        $phone_before = substr($data->data[$i]->phone,0,3);
                        $phone_after = substr($data->data[$i]->phone,-1,3);
                        $data->data[$i]->phone = (Auth::user()->can("customers-unmask"))?$data->data[$i]->phone:$phone_before."******".$phone_after;
                        for($j=0; $j < count($eap[0]["bnpl"]); $j++) 
                        {
                            $citizenID_before = substr($data->data[$i]->bnpl[$j]->citizenId,-3);
                            $data->data[$i]->bnpl[$j]->citizenId = (Auth::user()->can("customers-unmask"))?$data->data[$i]->bnpl[$j]->citizenId:"*********".$citizenID_before;
                        }
                        $output .= ' <a href="'.url(route('customer.show',['id'=>$data->data[$i]->_id])).'#eap_info" class="btn btn-info btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-eye"></i></a>';
                        $output .= ' <a data-toggle="modal" data-target="#demoModal-'.$data->data[$i]->_id.'" data-id="'.$data->data[$i]->_id.'" class="btn btn-danger btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-ban"></i></a>';
                        $output .= ' <button class="btn btn-danger btn-xs btnDelete" onclick="delete1($(this))" type="button" title="click here"  data-id="'.$data->data[$i]->_id.'"><i class="fa fa-times"></i></button>';
                        $data->data[$i]->action = (string)$output;
                        $data->data[$i]->urlphone = '<a href="'.url(route('customer.show',['id'=>$data->data[$i]->_id])).'#eap_info" > '.$data->data[$i]->phone.' </a>';

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
                        // $output .= '<button class="btn btn-warning btn-xs" label="Open Modal" data-toggle="modal" data-target="#exampleModal" type="submit"><i class="fa fa-edit"></i></button>';
                        $output .= ' <a href="'.url(route('customer.show',['id'=>$data->data[$i]->_id])).'" class="btn btn-info btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-eye"></i></a>';
                        // $output .= Form::open(['route' => [config('employee') . '.employee', $data->data[$i]->_id], 'method' => 'delete', 'style'=>'display:inline']);
                        // $output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
                        // $output .= Form::close();
                        // $data->data[$i]->index = $i;
                        $output .= ' <a data-toggle="modal" data-target="#demoModal-'.$data->data[$i]->_id.'" data-id="'.$data->data[$i]->_id.'#bnpl_info" class="btn btn-danger btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-ban"></i></a>';
                        $output .= ' <button class="btn btn-danger btn-xs btnDelete" onclick="delete1($(this))" type="button" title="click here"  data-id="'.$data->data[$i]->_id.'"><i class="fa fa-times"></i></button>';
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
                // $result = $response->json();
                $out =  Datatables::of($result)->make(false);
                return $out;      
            }
            
        }
    }

    
}
