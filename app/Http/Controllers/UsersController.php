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

        // $role = Role::all();
        // return view('vendor.adminlte.users.index',['users'=> $users,"role"=>$role]);

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

    public function destroy(Request $request)
    {
        $user = User::find($request->id);
        $user->delete();
        $user->delete_at = 1;
        $user->save();
        return redirect()->route('users')->with('delete','User Deleted Successfull');

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
                $user = User::whereNull("isDelete");
                if(!empty($request->name)) $user->where("name",$request->name);
                if(!empty($request->email)) $user->where("email",$request->email);
                if(!empty($request->status)) 
                {
                    if($request->status == 'Active')
                    {
                        $user->where("delete_at",'');
                        
                    }
                    else
                    {
                        $user->where("delete_at",1);
                    }
                }
                if(!empty($request->reservation)) {
                    if(!empty($request->name)){
                    $date = explode(" - ",$request->reservation);
                    $from = Carbon::parse($date[0]);
                    $to = Carbon::parse($date[1].' 23:59');
                    $user->whereBetween("created_at", [$from,$to]);
                    // $cus->where('createdAt',array('$gte' => $from,'$lte' => $to));
                    }
                    else
                    {
                        $out =  Datatables::of(User::where("_id",1)->get())->make(true);
                        return $out;      
                    }
                }
                $out =  Datatables::of($user->get())->make(true);
                $data = $out->getData();   
                for($i=0; $i < count($data->data); $i++) {
                    $roles = new Role;
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
                            $output .= ' <a href="'.url(route('users.show',['id'=>$data->data[$i]->_id])).'" class="btn btn-info btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-eye"></i></a>';
                            $output .= ' <a href="'.url(route('users.edit',['id'=>$data->data[$i]->_id])).'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
                            $output .= ' <a data-toggle="modal" data-target="#demoModal-'.$data->data[$i]->_id.'" data-id="'.$data->data[$i]->_id.'" class="btn btn-danger btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-ban"></i></a>';
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
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                        <button type="button" class="btn" data-dismiss="modal">Close</button>
                                                    </div>
                                                    </div>
                                            </div>
                                            </div>
                                    </form>
                            ';
                        }else{
                            $output .= ' <a href="'.url(route('users.show',['id'=>$data->data[$i]->_id])).'" class="btn btn-info btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-eye"></i></a>';
                            // $output .= ' <a href="'.url(route('users.restore',['id'=>$data->data[$i]->_id])).'" class="btn btn-success btn-xs" style="display:inline;padding:2px 5px 3px 5px;" onclick="return confirm(\'Are you sure? \')"><i class=""></i></a>';
                            $output .= ' <a data-toggle="modal" data-target="#demoModal-'.$data->data[$i]->_id.'" data-id="'.$data->data[$i]->_id.'" class="btn btn-success btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-sync"></i></a>';
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
                                                        <button type="submit" class="btn btn-danger">Delete</button>
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
