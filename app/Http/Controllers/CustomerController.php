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
            return redirect()->route("customer")->with('Create news successfully');
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
        return redirect()->route('customer')->with('Customers deleted successfull');
    }


    public function dtajax(Request $request){
        if ($request->ajax()) {
            if(!empty($request->action))
            {
                $cus = Customer::whereNull("isDelete");
                if(!empty($request->username)) $cus->where("username",$request->username);
                if(!empty($request->email)) $cus->where("email",$request->email);
                if(!empty($request->phone)) $cus->where("phone",$request->phone);
                if(!empty($request->reservation)) {
                    if(!empty($request->username)){
                    $date = explode(" - ",$request->reservation);
                    $from = Carbon::parse($date[0]);
                    $to = Carbon::parse($date[1].' 23:59');
                    $cus->whereBetween("createdAt", [$from,$to]);
                    // $cus->where('createdAt',array('$gte' => $from,'$lte' => $to));
                    }
                    else
                {
                    $out =  Datatables::of(Customer::where("_id",1)->get())->make(true);
                    return $out;      
                }
                }
                $out =  Datatables::of($cus->get())->make(true);
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
                    $output .= '
                    <form method="post" action="'.url(route('customer.delete')).'">
                            <input type="hidden" name="id" value="'.$data->data[$i]->_id.'">
                            <input type="hidden" name="_token" value="'.csrf_token().'" />
                                <div class="modal" id="demoModal-'.$data->data[$i]->_id.'">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Do you want delete? </h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                                <button type="button" class="btn" data-dismiss="modal">Close</button>
                                            </div>
                                            </div>
                                    </div>
                                    </div>
                            </form>
                    ';
                    $data->data[$i]->action = (string)$output;

                }
                $out->setData($data);
                return $out;
                    
            }
            else
            {
                $out =  Datatables::of(Customer::where("_id",1)->get())->make(true);
                return $out;      
            }
            
        }
    }

    
}
