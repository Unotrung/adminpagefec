<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use DataTables;

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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
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
        $customer->password = Hash::make($request->password);
        $customer->save();
        return redirect()->route("customer")->with('Create news successfully');
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



    public function dtajax(Request $request){
        if ($request->ajax()) {
            $out =  Datatables::of(Customer::All())->make(true);
            $data = $out->getData();
            for($i=0; $i < count($data->data); $i++) {

                $output = '';
                // $output .= '<button class="btn btn-warning btn-xs" label="Open Modal" data-toggle="modal" data-target="#exampleModal" type="submit"><i class="fa fa-edit"></i></button>';
                $output .= ' <a href="'.url(route('employee.edit').'/'.$data->data[$i]->_id).'" class="btn btn-danger btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-ban"></i></a>';
                $output .= ' <a href="'.url(route('customer.show',['id'=>$data->data[$i]->_id])).'" class="btn btn-info btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-eye"></i></a>';
                // $output .= Form::open(['route' => [config('employee') . '.employee', $data->data[$i]->_id], 'method' => 'delete', 'style'=>'display:inline']);
                // $output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
                // $output .= Form::close();
                // $data->data[$i]->index = $i;
                $data->data[$i]->action = (string)$output;

            }
            $out->setData($data);
            return $out;
        }
    }

    
}
