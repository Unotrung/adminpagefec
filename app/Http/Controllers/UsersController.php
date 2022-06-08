<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Configuration;
use DataTables;
use App\Models\Permission;
use Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;
use RealRashid\SweetAlert\Facades\Alert;
use Auth;
use Illuminate\Validation\Rule;

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
        // $role = Role::all();
        // return view('vendor.adminlte.users.index',['users'=> $users,"role"=>$role]);

        $roles = Role::All()->where('name','!=', 'super admin');
        return view('vendor.adminlte.users.index',['users'=> $users,'roles'=>$roles]);

    }

    public function edit($id)
    {
        $user = User::find($id);
        $config = Configuration::where("is_used",1)->first();
        $configdiv = $config->division;
        $configcen = $config->center;
        $configdep = $config->department;
        $roles = Role::All()->where('name','!=', 'super admin');
        $permissions = Permission::All();
        return view('vendor.adminlte.users.edit',['user'=> $user, 'roles'=>$roles, 'permissions'=>$permissions,'configdiv'=>$configdiv,'configcen'=>$configcen,'configdep'=>$configdep]);
    }

    public function assign( Request $request ){
        $user = User::find($id);
        $roles = Role::All();
        return view('vendor.adminlte.users.edit',['user'=> $user, 'roles'=>$roles]);
    }

    public function create()
    {
        // $roles = Role::All();
        $config = Configuration::where("is_used",1)->first();
        $configdiv = $config->division;
        $configcen = $config->center;
        $configdep = $config->department;
        // print_r($config);
        // exit;
        $roles = Role::All()->where('is_delete','==', null);
        return view('vendor.adminlte.users.create',['roles'=>$roles,'configdiv'=>$configdiv,'configcen'=>$configcen,'configdep'=>$configdep]);
    }

    public function store(Request $request)
    {
        // print_r($request);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password_confirmation' => ['required'],
            'password' => ['required', 'confirmed', Rules\Password::min(10)->mixedCase()
            ->numbers()
            ->symbols()
            ->uncompromised()],
            'department' =>['required' , 'string'],
            'role' =>['required'],
        ]);
        
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'department' => $request->department,
            'division' => $request->division,
            'center'=> $request->center,
            'password' => Hash::make($request->password),
        ]);
        // print_r($user);
        // exit;
        $user->assignRole($request->role);
        event(new Registered($user));

        return redirect()->route('users')->with('add','User Registed Successfully');
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('vendor.adminlte.users.show',['user'=>$user]);
    }

    public function update(Request $request)
    {
        // print_r($request->id);
        // exit;   
        $user = User::find($request->id);
        $request->validate([
            'name' => 'required',
            'email' => [
                'required',
                // Rule::unique('users')->ignore($user->id,'id'),
            ],
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone; 
        $user->department = $request->department;
        $user->center = $request->center;
        $user->division = $request->division;
        $result = $user->save();
        if($result == 1){
            return redirect()->route('users.show', ['id' => $request->id])->with('success','Updated Users successfully');
        }
        else
        {
            return 2;
        }
    }

    public function assignRole(Request $request){
        $user = User::find($request->id);
        $role_checked = $request->role;

        $roles = Role::All()->whereNull('is_delete');
        $str = "";
        foreach($roles as $role){
            //remove all role
            $user->removeRole($role->name);
            
        }
        if(isset($request->role)) $user->assignRole($request->role);
        
        // $user->save();
        return redirect()->route('users.edit',['id' => $request->id."#settings"])->with('success','Role updated successfully.');

    }

    public function removeRole(Request $request){
        $user = User::find($request->id);
         return $user->removeRole($request->role);

    }

    public function destroy(Request $request)
    {
        $user_login = Auth::user();
        $role = Role::All(); 
        // print_r($request->role);
        foreach($role as $role)
        {
            if($role->user_ids != null)
            {
                if(in_array($request->id,$role->user_ids)){
                    print_r($role->user_ids);
                    $arr = $role->user_ids;
                    $key = array_search($request->id,$role->user_ids);
                    unset($arr[$key]);
                }
            }
        }
        $id_login = $user_login->id;
        $user = User::find($request->id);
        // print_r($user);
        
        if($id_login == $request->id)
        {
            return redirect()->route('users')->with('checkfalse','Can`t Deactivate Yourself');
        }
        $user->delete();
        $user->delete_at = 1;
        $user->save();
        return redirect()->route('users')->with('delete','Deactivated User Successfully');

    }

    public function restore(Request $request)
    {
        $user = User::find($request->id);
        $user->delete_at = null;
        $user->save();
        return redirect()->route('users')->with('Update','User restore Successfully');
    }

    public function dtajax(Request $request){
        if ($request->ajax()) 
        {
                $user = User::where('delete_at',1);
                if(empty($request->status)){
                    $user = User::whereNull('delete_at');
                }

                if(!empty($request->type))
                {
                    if($request->type != "role"){
                        $user->where($request->type,$request->input);
                    }
                    else{
                        $data = $request->input;
                        $user->whereHas('roles', function ($query) use ($data) {
                            return $query->where('name',"like", $data."%");
                        });
                    }
                }else{
                    // $user->whereHas('roles', function ($query) {
                    //     return $query->where('name','!=', 'super admin');
                    // });
                }
                $out =  Datatables::of($user->get())->make(true);
                // print($out);
                // exit;
                $data = $out->getData();   
                for($i=0; $i < count($data->data); $i++) {
                    $roles = new Role;
                    // $name_before = substr($data->data[$i]->email,0,3);
                    // $name_after = substr($data->data[$i]->email,-4,4);
                    // $data->data[$i]->email = (Auth::user()->can("users-unmask"))?$data->data[$i]->email:$name_before."***@***".$name_after;
                    if(empty($data->data[$i]->role_ids[0])){
                        $data->data[$i]->role = " ";
                    }
                    else{
                     $role = $roles->find($data->data[$i]->role_ids[0]);
                     $data->data[$i]->role =$role->name;
                    }
                    
                    $output = '';
                        if(empty($data->data[$i]->delete_at)){
                            $data->data[$i]->delete_at = "";
                            $output .= ' <a href="'.url(route('users.show',['id'=>$data->data[$i]->_id])).'" class="btn btn-info btn-xs" data-toggle="tooltip" title="Show Details" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-eye"></i></a>';
                            if(Auth::user()->can('users-update')){
                            $output .= ' <a href="'.url(route('users.edit',['id'=>$data->data[$i]->_id])).'#activity" class="btn btn-warning btn-xs" data-toggle="tooltip" title="Edit User" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
                            }
                            if(Auth::user()->can('users-delete')){
                                $output .= ' <span data-toggle="modal" data-target="#demoModal-'.$data->data[$i]->_id.'" data-id="'.$data->data[$i]->_id.'"> 
                                <a data-toggle="tooltip" class="btn btn-danger btn-xs" title="Deactivate User" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-ban"></i></a></span>';
                            $output .= '
                            <form method="post" action="'.url(route('users.delete')).'">
                                    <input type="hidden" name="id" value="'.$data->data[$i]->_id.'">
                                    <input type="hidden" name="_token" value="'.csrf_token().'" />
                                        <div class="modal" id="demoModal-'.$data->data[$i]->_id.'">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Do you want to Deactive User? </h4> 
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-danger">Deactivate</button>
                                                        <button type="button" class="btn" data-dismiss="modal">Close</button>
                                                    </div>
                                                    </div>
                                            </div>
                                            </div>
                                    </form>
                            ';
                            }
                        }else{
                            $output .= ' <a href="'.url(route('users.show',['id'=>$data->data[$i]->_id])).'" class="btn btn-info btn-xs" data-toggle="tooltip" title="Show Details" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-eye"></i></a>';
                            // $output .= ' <a href="'.url(route('users.restore',['id'=>$data->data[$i]->_id])).'" class="btn btn-success btn-xs" style="display:inline;padding:2px 5px 3px 5px;" onclick="return confirm(\'Are you sure? \')"><i class=""></i></a>';
                            $output .= ' <span data-toggle="modal" data-target="#demoModal-'.$data->data[$i]->_id.'" data-id="'.$data->data[$i]->_id.'">
                            <a  class="btn btn-success btn-xs" data-toggle="tooltip" title="Active User" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-sync"></i></a></span>';
                            $output .= '
                            <form method="post" action="'.url(route('users.restore')).'">
                                    <input type="hidden" name="id" value="'.$data->data[$i]->_id.'">
                                    <input type="hidden" name="_token" value="'.csrf_token().'" />
                                        <div class="modal" id="demoModal-'.$data->data[$i]->_id.'">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Do you want to Active User? </h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success">Restore</button>
                                                        <button type="button" class="btn" data-dismiss="modal">Close</button>
                                                    </div>
                                                    </div>
                                            </div>
                                            </div>
                                    </form>
                            ';
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
