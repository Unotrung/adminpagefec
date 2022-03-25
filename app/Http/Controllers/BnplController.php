<?php

namespace App\Http\Controllers;

use App\Models\Bnpl;
use Illuminate\Http\Request;
use DataTables;



class BnplController extends Controller
{

    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
        $bnpl = new Bnpl;
        $bnpl->ncustomer = $request->ncustomer;
        $bnpl->phnumber = $request->phnumber;
        $bnpl->image = $request->image;
        $bnpl->nidcustomer = $request->nidcustomer;
        $bnpl->nidimage = $request->nidimage;
        $bnpl->Gender = $request->Gender;
        $bnpl->Pincode = $request->Pincode;
        $bnpl->DOB = $request->DOB;
        $bnpl->DON = $request->DON;
        $bnpl->DRegis = $request->DRegis;
        $bnpl->Address = $request->Address;
        $bnpl->Code = $request->Code;
        $bnpl->CodeName = $request->CodeName;
        $bnpl->DivisionType = $request->DivisionType;
        $bnpl->District = $request->District;
        $bnpl->TypeRelation = $request->TypeRelation;
        $bnpl->PhoneRelation = $request->PhoneRelation;
        $bnpl->NameRelation = $request->NameRelation;
        $bnpl->Contract = $request->Contract;
        $bnpl->save();
        return response()->json(['message'=>'Added successfully'],201);
    }


    // public function edit($id)
    // {
    //     $bnpl = Bnpl::find($id);
    //     return view('vendor.adminlte.bnpl.bnpledit',compact('bnpl','id'));
    // }
    public function update(Request $request, $id)
    {
        $bnpl= Bnpl::find($id);
        // $bnpl->ncustomer = $request->ncustomer;
        $bnpl->ncustomer = $request->get('ncustomer');
        $bnpl->phnumber = $request->get('phnumber');
        $bnpl->image = $request->get('image');
        $bnpl->nidcustomer = $request->get('nidcustomer');
        $bnpl->nidimage = $request->get('nidimage');
        $bnpl->Gender = $request->get('Gender');
        $bnpl->Pincode = $request->get('Pincode');
        $bnpl->DOB = $request->get('DOB');
        $bnpl->DON = $request->get('DON');
        $bnpl->DRegis = $request->get('DRegis');
        $bnpl->Address = $request->get('Address');
        $bnpl->Code = $request->get('Code');
        $bnpl->CodeName = $request->get('CodeName');
        $bnpl->DivisionType = $request->get('DivisionType');
        $bnpl->District = $request->get('District');
        $bnpl->TypeRelation = $request->get('TypeRelation');
        $bnpl->PhoneRelation = $request->get('PhoneRelation');
        $bnpl->NameRelation = $request->get('NameRelation');
        $bnpl->Contract = $request->get('Contract');
        // $bnpl->model = $request->get('model');
        // $bnpl->price = $request->get('price');        
        $bnpl->save();
        return redirect('bnpl')->with('success', 'bnpl has been successfully update');
    }


    public function edit($id){
        $bnpl = Bnpl::find($id);
			if(isset($bnpl->_id)) {
				$setErrorsBag = "khong hien thi";
				return view('vendor.adminlte.bnpl.edit',[])->with('bnpl', $bnpl);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("bnpl"),
				]);
			}
    }



    public function index()
    {
        // $api_url = 'https://api-wolfconsulting-bnpl.herokuapp.com/v1/user/getAllUser';
        // $json_data = file_get_contents($api_url);
        // $response_data = json_decode($json_data);
        // $user_data = $response_data->data;
        $bnpl = Bnpl::all();
        return view('vendor.adminlte.bnpl.bnpl',compact('bnpl'));
    }

    public function dtajax(Request $request){
         if ($request->ajax()) {
            $out =  Datatables::of(Bnpl::All())->make(true);
            $data = $out->getData();
            for($i=0; $i < count($data->data); $i++) {
                $output = '';
                $output .= ' <a href="'.url(route('bnpl.edit').'/'.$data->data[$i]->_id).'" class="btn btn-info btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-eye"></i></a>';
                $data->data[$i]->action = (string)$output;
            //     if($this->show_action) {
            //         $output = '';
            // //         // $output .= '<button class="btn btn-warning btn-xs" label="Open Modal" data-toggle="modal" data-target="#exampleModal" type="submit"><i class="fa fa-edit"></i></button>';
            //         $output .= ' <a href="'.url(route('bnpl.edit').'/'.$data->data[$i]->_id).'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
            // //         // $output .= ' <a href="'.url(route('employee.show',['id'=>$data->data[$i]->_id])).'" class="btn btn-info btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-eye"></i></a>';
            // //         // $output .= Form::open(['route' => [config('employee') . '.employee', $data->data[$i]->_id], 'method' => 'delete', 'style'=>'display:inline']);
            // //         // $output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
            //             // $output .= Form::close();
            //         $data->data[$i]->action = (string)$output;
            //     }
             }
            $out->setData($data);
            return $out;
        }
    }




}