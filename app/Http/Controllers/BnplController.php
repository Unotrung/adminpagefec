<?php

namespace App\Http\Controllers;

use App\Models\Bnpl;
use App\Models\Provider;
use Illuminate\Http\Request;
use DataTables;
use MongoDB\Operation\Find;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

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
        // $bnpl->model = $request->get('model');
        // $bnpl->price = $request->get('price');        
        $bnpl->save();
        return redirect('bnpl')->with('success', 'bnpl has been successfully update');
    }


    public function edit($id){
        // $bnpl = Bnpl::find($id);
        // $bnpl_providers = $bnpl->providers;
        // $bnpl_provider = Provider::all();
        
		// 	if(isset($bnpl->_id)) {
		// 		$setErrorsBag = "khong hien thi";
		// 		return view('vendor.adminlte.bnpl.edit',["bnpl"=>$bnpl,"bnpl_providers"=>$bnpl_providers,"bnpl_provider"=>$bnpl_provider]);
		// 	} else {
		// 		return view('errors.404', [
		// 			'record_id' => $id,
		// 			'record_name' => ucfirst("bnpl"),
		// 		]);
		// 	}
        $data_bnpl = Http::get(env("API_PARTNER").'/v1/admin/getUserBNPL/'.$id);
        if(!empty($data_bnpl))
        {
            
            $bnpls = $data_bnpl->json();
            $bnpl = $bnpls["data"];
        }
        else
        {
            $bnpl = "";
        }
        // print_r($bnpl);
        // exit;
        // $user = Auth::user();
        // $roles = new Role;
        // $permissions = new Permission;
        // $check_permission=[];
        //             // print_r($user->role_ids[0]);
        //             $role = Role::find($user->role_ids[0]);
        //             $check_role = $role->permission_ids;
        //             for($i=0;$i < count($check_role); $i++)
        //             {
        //                 if(empty($check_role[$i])){
        //                     $user->permission = "";
        //                 }
        //                 else
        //                 {
        //                 $permission = $permissions->find($check_role[$i]);
        //                 $check_permission[$i]=$permission->name;
        //                 }
        //             }
        //             $eap_check= in_array('customers-view-eap', $check_permission);
        //             $bnpl_check = in_array('customers-view-bnpl', $check_permission);
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
        return view('vendor.adminlte.bnpl.edit',["bnpl"=>$bnpl]);
    }



    public function index()
    {
        // $api_url = 'https://api-wolfconsulting-bnpl.herokuapp.com/v1/user/getAllUser';
        // $json_data = file_get_contents($api_url);
        // $response_data = json_decode($json_data);
        // $user_data = $response_data->data;
        $name_array = Bnpl::Where('name','=',null)->get();
        $phone_array = Bnpl::Where('phone','=',null)->get();
        $identify_array = Bnpl::Where('name','!=',null)->get();
        $data_bnpl = Http::get(env("API_PARTNER").'/v1/admin/getAllBNPLPersonal');
        if(!empty($data_bnpl))
        {
            
            $bnpls = $data_bnpl->json();
            $bnpl = $bnpls["data"];
        }
        else
        {
            $bnpl = "";
        }
        // $bnpl = Bnpl::all();
        return view('vendor.adminlte.bnpl.bnpl',['bnpl'=>$bnpl,'identify'=>$identify_array,'phone'=>$phone_array,'name'=>$name_array]);
    }


    // public function destroy($id)
    // {
    //     $promotion = News::find($id);
    //     $promotion->is_delete = 1;
    //     $promotion->save();
    //     return redirect()->route('news.index')->with('News deleted successfull');
    // }

    public function dtajax(Request $request){
         if ($request->ajax()) {
            if(!empty($request->search))
            {
                // $bnpl = Bnpl::whereNull("isDelete");
                // if(!empty($request->name)) $bnpl->where("name",$request->name);
                // //if(!empty($request->status)) $bnpl->where("email",$request->status);
                // if(!empty($request->phone)) $bnpl->where("phone",$request->phone);
                // if(!empty($request->reservation)) {
                //     $date = explode(" - ",$request->reservation);
                //     $from = Carbon::parse($date[0]);
                //     $to = Carbon::parse($date[1].' 23:59');
                //     $bnpl->whereBetween("createdAt", [$from,$to]);
                //     // $cus->where('createdAt',array('$gte' => $from,'$lte' => $to));
                // }
                $response = Http::get(env("API_PARTNER").'/v1/admin/searchBNPL', [
                    'search' => $request->search,
                    'value' => $request->value,
                    // 'form' => $request->from,
                    // 'to' => $request->to
                ]);
                $result = $response->json();
                // print_r(); exit;
                $out =  Datatables::of($result["data"])->make(true);
                
                $data = $out->getData();
                for($i=0; $i < count($data->data); $i++) {
                $output = '';
                $output .= ' <a href="'.url(route('bnpl.edit',['id'=>$data->data[$i]->_id])).'#bnpl_info" class="btn btn-info btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-eye"></i></a>';
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