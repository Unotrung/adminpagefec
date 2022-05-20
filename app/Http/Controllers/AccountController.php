<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserInfo;

use Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Collection;
use Auth;

class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // $app->configure('permission');
    // $app->register(Maklad\Permission\PermissionServiceProvider::class);
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function show()
    {
        $timechange = UserInfo::All()->sortByDesc("created_at")->skip(0)->take(10);
        // print_r($timechange);
        // exit;
        return view('vendor.adminlte.account.show',["timechange"=>$timechange]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone; 
        $user->department = $request->department;
        $user->center = $request->center;
        $user->division = $request->division;
        $result = $user->save();
        if($result == 1){
            $UserInfo = UserInfo::create([
                'user_id' => $request->id,
                'type' => "Information",
            ]);
            return redirect()->route('account.show');
        }
        else
        {
            return 2;
        }
    }

   

}
