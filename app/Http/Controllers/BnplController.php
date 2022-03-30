<?php

namespace App\Http\Controllers;

use App\Models\Bnpl;
use App\Models\Provider;
use Illuminate\Http\Request;
use DataTables;
use MongoDB\Operation\Find;

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
        $bnpl = Bnpl::find($id);
        $bnpl_providers = $bnpl->providers;
        $bnpl_provider = Provider::all();
			if(isset($bnpl->_id)) {
				$setErrorsBag = "khong hien thi";
				return view('vendor.adminlte.bnpl.edit',["bnpl"=>$bnpl,"bnpl_providers"=>$bnpl_providers,"bnpl_provider"=>$bnpl_provider]);
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

    // public function destroy($id)
    // {
    //     $promotion = News::find($id);
    //     $promotion->is_delete = 1;
    //     $promotion->save();
    //     return redirect()->route('news.index')->with('News deleted successfull');
    // }

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