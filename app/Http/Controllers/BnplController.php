<?php

namespace App\Http\Controllers;

use App\Models\Bnpl;
use Illuminate\Http\Request;

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


    public function edit($id)
    {
        $bnpl = Bnpl::find($id);
        return view('vendor.adminlte.bnpl.bnpledit',compact('bnpl','id'));
    }
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

    public function index()
    {
        $bnpl=Bnpl::all();
        return view('vendor.adminlte.bnpl.bnpl',compact('bnpl'));
    }
}