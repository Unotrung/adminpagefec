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
        $bnpl->save();
        return response()->json(['message'=>'Added successfully'],201);
    }


    public function index()
    {
        $bnpl=Bnpl::all();
        return view('vendor.adminlte.bnpl',compact('bnpl'));
    }
}
