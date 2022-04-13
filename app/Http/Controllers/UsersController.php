<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use DataTables;
use App\Models\Permission;
use Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;
use RealRashid\SweetAlert\Facades\Alert;

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
        $roles = Role::All();
        return view('vendor.adminlte.users.index',['users'=> $users,'roles'=>$roles]);
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
        $roles = Role::All();
        return view('vendor.adminlte.users.create',['roles'=>$roles]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' =>['required'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->role);

        event(new Registered($user));

        return redirect()->route('users')->with('add','User Registed Successfull');
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

        $user->delete_at = 1;
        $user->save();
        return redirect()->route('users')->with('User deleted successfull');

    }

    public function restore($id)
    {
        $user = User::find($id);
        $user->delete_at = "";
        $user->save();
        return redirect()->route('users')->with('User restore successfull');
    }

    public function dtajax(Request $request){
        if ($request->ajax()) {
        $out =  DataTables::of(User::All())->make(true);
        //    $data = $out->getData();
        //    for($i=0; $i < count($data->data); $i++) {
        //        $output = '';
        //         if(empty($data->data[$i]->delete_at)){
        //             $data->data[$i]->delete_at = "";
        //             $output .= ' <a href="'.url(route('users.show',['id'=>$data->data[$i]->_id])).'" class="btn btn-info btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-eye"></i></a>';
        //             $output .= ' <a href="'.url(route('users.edit',['id'=>$data->data[$i]->_id])).'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
        //             $output .= ' <a href="'.url(route('users.delete',['id'=>$data->data[$i]->_id])).'" class="btn btn-danger btn-xs" style="display:inline;padding:2px 5px 3px 5px;" onclick="return confirm(\'Are you sure? \')"><i class="fa fa-ban"></i></a>';
        //         }else{
        //             $output .= ' <a href="'.url(route('users.show',['id'=>$data->data[$i]->_id])).'" class="btn btn-info btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-eye"></i></a>';
        //             $output .= ' <a href="'.url(route('users.restore',['id'=>$data->data[$i]->_id])).'" class="btn btn-success btn-xs" style="display:inline;padding:2px 5px 3px 5px;" onclick="return confirm(\'Are you sure? \')"><i class="fa fa-sync"></i></a>';
        //         }
        //         if(empty($data->data[$i]->role_ids)){
        //             $data->data[$i]->role_ids = "";
        //         }
        //         else{
        //             $role_data = Role::find($data->data[$i]->role_ids);
        //             $data->data[$i]->role_ids = $role_data[0]['display_name'];
        //         }
        //        $data->data[$i]->action = (string)$output;
        //         if(empty($data->data[$i]->status)){
        //             $data->data[$i]->status = "";
        //         }
        //         if(!empty($request->reservation)) {
        //             if(!empty($request->name)){
        //             $date = explode(" - ",$request->reservation);
        //             $from = Carbon::parse($date[0]);
        //             $to = Carbon::parse($date[1].' 23:59');
        //             $user->whereBetween("created_at", [$from,$to]);
        //             // $cus->where('createdAt',array('$gte' => $from,'$lte' => $to));
        //             }
        //             else
        //             {
        //                 $out =  Datatables::of(User::where("_id",1)->get())->make(true);
        //                 return $out;      
        //             }
        //         }
        //         $out =  Datatables::of($user->get())->make(true);
                $data = $out->getData();   
                for($i=0; $i < count($data->data); $i++) {
                    $output = '';
                        if(empty($data->data[$i]->delete_at)){
                            $data->data[$i]->delete_at = "";
                            $output .= ' <a href="'.url(route('users.show',['id'=>$data->data[$i]->_id])).'" class="btn btn-info btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-eye"></i></a>';
                            $output .= ' <a href="'.url(route('users.edit',['id'=>$data->data[$i]->_id])).'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
                            $output .= ' <a href="'.url(route('users.delete',['id'=>$data->data[$i]->_id])).'" class="btn btn-danger btn-xs" style="display:inline;padding:2px 5px 3px 5px;" onclick="return confirm(\'Are you sure? \')"><i class="fa fa-ban"></i></a>';
                        }else{
                            $output .= ' <a href="'.url(route('users.show',['id'=>$data->data[$i]->_id])).'" class="btn btn-info btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-eye"></i></a>';
                            $output .= ' <a href="'.url(route('users.restore',['id'=>$data->data[$i]->_id])).'" class="btn btn-success btn-xs" style="display:inline;padding:2px 5px 3px 5px;" onclick="return confirm(\'Are you sure? \')"><i class="fa fa-sync"></i></a>';
                        }
                        $data->data[$i]->action = (string)$output;
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
