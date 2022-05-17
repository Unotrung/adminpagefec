<?php

namespace App\Http\Controllers;

use App\Models\Bnpl;
use App\Models\Provider;
use Illuminate\Http\Request;
use DataTables;
use MongoDB\Operation\Find;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Response;

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

        $data_bnpl = $this->_refreshTokenResponse(env("API_PARTNER").'/v1/admin/getUserBNPL/'.$id);
        if(!empty($data_bnpl))
        {
            
            $bnpls = $data_bnpl->json();
            $bnpl = $bnpls["data"];
        }
        else
        {
            $bnpl = "";
        }
        return view('vendor.adminlte.bnpl.edit',["bnpl"=>$bnpl]);
    }



    public function index()
    {
        // $api_url = 'https://api-wolfconsulting-bnpl.herokuapp.com/v1/user/getAllUser';
        // $json_data = file_get_contents($api_url);
        // $response_data = json_decode($json_data);
        // $user_data = $response_data->data;
        // $name_array = Bnpl::Where('name','=',null)->get();
        // $phone_array = Bnpl::Where('phone','=',null)->get();
        // $identify_array = Bnpl::Where('name','!=',null)->get();
        $name_array = [];
        $phone_array = [];
        $identify_array = [];
        $bnpl = [];
        // // $data_bnpl = Http::get(env("API_PARTNER").'/v1/admin/getAllBNPLPersonal');
        // $data_bnpl = $this->_refreshTokenResponse(env("API_PARTNER").'/v1/admin/getAllBNPLPersonal');
        // // print_r($data_bnpl->json());exit;
        // if(!empty($data_bnpl->json()))
        // {
            
        //     $bnpls = $data_bnpl->json();
        //     $bnpl = $bnpls["data"];
        // }
        // else
        // {
            
        // }
        // $bnpl = Bnpl::all();
        return view('vendor.adminlte.bnpl.bnpl',['bnpl'=>$bnpl,'identify'=>$identify_array,'phone'=>$phone_array,'name'=>$name_array]);
    }

    public function dtajax(Request $request){
         if ($request->ajax()) {
            if(!empty($request->search))
            {
                
                $response = $this->_refreshTokenResponse(env("API_PARTNER").'/v1/admin/searchBNPL',[
                    'search' => $request->search,
                    'value' => $request->value,
                    'form' => $request->from,
                    'to' => $request->to
                ]);
                $result = $response->json();

                $out =  Datatables::of($result["data"])->make(true);
                
                $data = $out->getData();
                for($i=0; $i < count($data->data); $i++) {
                $output = '';
                $output .= ' <a href="'.url(route('bnpl.edit',['id'=>$data->data[$i]->_id])).'#bnpl_info" class="btn btn-info btn-xs" data-toggle="tooltip" title="Show Details" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-eye"></i></a>';
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

    public function report(){
        $response = $this->_refreshTokenResponse(env("API_PARTNER").'/v1/admin/getReportBNPL');
        if(!empty($response->json()))
        {
            return response($response->json());
        }
        $data["code"]=0;
        $data["message"] = "fail";
        return response($data);

    }

    private function _apiAccessToken(){

        $user = "LARAVEL6";
        $pass = "12345678";

        //existed token
        if(session('apitoken') !== null){
            $token = session('apitoken');
            return true;
        }

        //login & get Token
        $res = Http::contentType('application/json')
            ->send('POST',env("API_PARTNER").'/v1/admin/login',["body"=> '{"username": "'.$user.'","password": "'.$pass.'"}'])
            ->json();   
        try{
            if(isset($res["status"]) && $res["status"] == 1){
                session(['apitoken' => $res["data"]["token"]]);
            }
        }
        catch(e){
            return false;
        }
        return true;
    }

    private function _refreshTokenResponse($url,$req = array()){

        //get token
        if(session("apitoken") === ''){
            $this->_apiAccessToken();
        }

        //refresh token and response data
        $response = Http::withHeaders([
            'x-access-token' => session("apitoken")
        ])->get($url,$req);

        if(empty($response->json())){
            session(['apitoken' => null]);
            $this->_apiAccessToken();
            $response = Http::withHeaders([
                'x-access-token' => session("apitoken")
            ])->get($url,$req);
        }

        return $response;

    }




}