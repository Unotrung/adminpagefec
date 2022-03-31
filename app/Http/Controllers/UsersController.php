<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use DataTables;
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

    public function edit($id)
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
        return redirect()->route('users.index')->with('success','User created successfully.');
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('vendor.adminlte.users.show',['user'=>$user]);
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
        $result = $user->save();
        if($result == 1){
            return redirect()->route('users.show', ['id' => $request->id])->with('success','User updated successfully.');
        }
        else
        {
            return 2;
        }
        
    }

    public function assignRole(Request $request){
        $user = User::find($request->id);
        
        return $user->assignRole($request->role);

    }

    public function removeRole(Request $request){
        $user = User::find($request->id);
         
         return $user->removeRole($request->role);

    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('users.index')->with('Promotions deleted successfull');
    }

    public function dtajax(Request $request){
        if ($request->ajax()) {
        $out =  DataTables::of(User::All())->make(true);
           $data = $out->getData();
           for($i=0; $i < count($data->data); $i++) {
               $output = '';
               $output .= ' <a href="'.url(route('users.show',['id'=>$data->data[$i]->_id])).'" class="btn btn-info btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-eye"></i></a>';
                $output .= ' <a href="'.url(route('users.edit',['id'=>$data->data[$i]->_id])).'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
               $output .= ' <a href="'.url(route('users.delete',['id'=>$data->data[$i]->_id])).'" class="btn btn-danger btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-ban"></i></a>';
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
                if(empty($data->data[$i]->status)){
                    $data->data[$i]->status = "";
                }
                if(empty($data->data[$i]->phone)){
                    $data->data[$i]->phone = "";
                }
            }
           $out->setData($data);
           return $out;
        }
    }

}
