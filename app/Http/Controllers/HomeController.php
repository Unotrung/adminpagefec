<?php

namespace App\Http\Controllers;
use App\Models\Bnpl;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $bnpl = Bnpl::All();
        return view('home',['bnpl'=>$bnpl]);
    }
}
