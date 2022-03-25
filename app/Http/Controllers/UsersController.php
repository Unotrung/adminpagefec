<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Session;

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
        $users = User::All();
        return view('vendor.adminlte.users.index',['users'=> $users]);
    }

    public function edit($id = null)
    {
        $user = User::find($id);
        $roles = Role::All();
        $permissions = Permission::All();
        return view('vendor.adminlte.users.edit',['user'=> $user, 'roles'=>$roles, 'permissions'=>$permissions]);
    }

    public function assign( Request $request ){
        $user = User::find($id);
        $roles = Role::All();
        return view('vendor.adminlte.users.edit',['user'=> $user, 'roles'=>$roles]);
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

    // public function edit($id)
    // {
    //     $user = User::find($id);
    //     return view('vendor.adminlte.users.edit', ['user' => $user->id]);
    // }

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
        $user->save();

        return redirect()->route('users.edit', ['id' => $request->id])->with('success','User updated successfully.');
    }

    public function assignRole(Request $request){
        $user = User::find($request->id);
        return $user->assignRole($request->role);

    }

    public function removeRole(Request $request){
        $user = User::find($request->id);
         
         return $user->removeRole($request->role);

    }

}
