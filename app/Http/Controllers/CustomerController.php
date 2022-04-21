<?php

namespace App\Http\Controllers;

use App\Models\Customer;
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
        $cus = Customer::find($id);
			if(isset($cus->_id)) {
				$setErrorsBag = "khong hien thi";
				return view('vendor.adminlte.customers.show',[])->with('cus', $cus);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("cus"),
				]);
			}
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
                //{{admin}}/v1/admin/getAllEAP
                
                foreach($request->filter as $key=>$val){
                    if($val != null){
                        $strFilter .= $key."=".$val."&";
                    }
                }
                
                $strFilter = ($strFilter!="")?"?".$strFilter:"";
                $strFilter = rtrim($strFilter, "&");
                $response = Http::get('apiadmin.us-east-1.elasticbeanstalk.com/v1/admin/search'.$strFilter);
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
                        $output = '';
                        // $output .= '<button class="btn btn-warning btn-xs" label="Open Modal" data-toggle="modal" data-target="#exampleModal" type="submit"><i class="fa fa-edit"></i></button>';
                        $output .= ' <a href="'.url(route('customer.show',['id'=>$data->data[$i]->_id])).'" class="btn btn-info btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-eye"></i></a>';
                        // $output .= Form::open(['route' => [config('employee') . '.employee', $data->data[$i]->_id], 'method' => 'delete', 'style'=>'display:inline']);
                        // $output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
                        // $output .= Form::close();
                        // $data->data[$i]->index = $i;
                        $output .= ' <a data-toggle="modal" data-target="#demoModal-'.$data->data[$i]->_id.'" data-id="'.$data->data[$i]->_id.'" class="btn btn-danger btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-ban"></i></a>';
                        $output .= ' <button class="btn btn-danger btn-xs btnDelete" onclick="delete1($(this))" type="button" title="click here"  data-id="'.$data->data[$i]->_id.'"><i class="fa fa-times"></i></button>';
                        $data->data[$i]->action = (string)$output;

                    }
                    $out->setData($data);
                    return $out;
                }
                if($eap !=null && $bnpl != null)
                {
                    $eap[0]["bnpl"] = $result["data"]["BNPL"];
                    // foreach($result["data"]["BNPL"] as $key=>$bnpl){
                    //     $eap[$key]["bnpl"] = $bnpl;
                    // } 
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
                        $output .= ' <a data-toggle="modal" data-target="#demoModal-'.$data->data[$i]->_id.'" data-id="'.$data->data[$i]->_id.'" class="btn btn-danger btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-ban"></i></a>';
                        $output .= ' <button class="btn btn-danger btn-xs btnDelete" onclick="delete1($(this))" type="button" title="click here"  data-id="'.$data->data[$i]->_id.'"><i class="fa fa-times"></i></button>';
                        $data->data[$i]->action = (string)$output;

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
                        $output .= ' <a data-toggle="modal" data-target="#demoModal-'.$data->data[$i]->_id.'" data-id="'.$data->data[$i]->_id.'" class="btn btn-danger btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-ban"></i></a>';
                        $output .= ' <button class="btn btn-danger btn-xs btnDelete" onclick="delete1($(this))" type="button" title="click here"  data-id="'.$data->data[$i]->_id.'"><i class="fa fa-times"></i></button>';
                        $data->data[$i]->action = (string)$output;

                    }
                    $out->setData($data);
                    return $out;
                }
                $out =  Datatables::of([])->make(true);

                return $out;
            }
            else
            {
                // $response = Http::get('https://admin-voolo.herokuapp.com/v1/admin/getAllEAP');
                // $result = $response->json();
                // $out =  Datatables::of($result["data"])->make(true);
                // return $out;
                // $response = Http::get('apiadmin.us-east-1.elasticbeanstalk.com/v1/admin/search'.$strFilter);/
                $result["data"] = [];
                // $result = $response->json();
                $out =  Datatables::of($result)->make(false);
                return $out;      
            }
            
        }
    }

    
}
