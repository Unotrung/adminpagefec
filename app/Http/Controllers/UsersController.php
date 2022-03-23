<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
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
    public function index()
    {
        return view('vendor.adminlte.users.index');
    }

    public function create()
    {
        return view('vendor.adminlte.users.create');
    }

    public function store(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->role = $request->role;
        $user->status = 1;
        $user->save();
        return view('vendor.adminlte.users.index');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('vendor.adminlte.users.edit', ['user' => $user->id]);
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
        if($request->guard_name == 'admin')
        {
            $user->assignRole('admin');
        }
        else{
            $user->assignRole('user');
        }
        $user->save();
            
        return redirect()->route('users.index')->with('success','User updated successfully.');
    }

}
