<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jenssegers\Mongodb\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Maklad\Permission\Traits\HasRoles;
use Maklad\Permission\Models\Role;
use Maklad\Permission\Models\Permission;
use App\Models\User;
use DataTables;

class EmployeeController extends Controller
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
    public $show_action = true;
	public $view_col = 'name';
	public $listing_cols = ['name', 'email'];
    public function index()
    {
        

    // $role = Role::create(['name' => 'admin']);
    // $permission = Permission::create(['name' => 'user']);
    // $role->givePermissionTo($permission);
    // $permission->assignRole($role);
    // $users = User::role('admin')->get(); // Returns only users with the role 'writer'
// $users = User::permission('user')->get(); // Returns only users with the permission 'edit articles'
// auth()->user()->givePermissionTo('user');
$roles = Role::all();
$module = User::all();
        // if(Module::hasAccess($module->id)) {
            return View('vendor.adminlte.employee.index', [
                'show_actions' => $this->show_action,
                'listing_cols' => $this->listing_cols,
                'module' => $module
            ]);
        // } else {
        //     return redirect(config('laraadmin.adminRoute')."/");
        // }
        // return view('vendor.adminlte.employee.index',['roles' => $roles]);
        
    }

    public function dtajax(Request $request){
        if ($request->ajax()) {
            $out =  Datatables::of(User::All())->make(true);
            $data = $out->getData();
            for($i=0; $i < count($data->data); $i++) {
                if($this->show_action) {
                    $output = '';
                    // $output .= '<button class="btn btn-warning btn-xs" label="Open Modal" data-toggle="modal" data-target="#exampleModal" type="submit"><i class="fa fa-edit"></i></button>';
                    $output .= ' <a href="'.url(route('employee.edit').'/'.$data->data[$i]->_id).'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
                    $output .= ' <a href="'.url(route('employee.show',['id'=>$data->data[$i]->_id])).'" class="btn btn-info btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-eye"></i></a>';
                    // $output .= Form::open(['route' => [config('employee') . '.employee', $data->data[$i]->_id], 'method' => 'delete', 'style'=>'display:inline']);
                    // $output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
                    // $output .= Form::close();
                    $data->data[$i]->action = (string)$output;
                }
            }
            $out->setData($data);
            return $out;
        }
    }

    public function edit($id){
        $user = User::find($id);
			if(isset($user->_id)) {
				$setErrorsBag = "khong hien thi";
				return view('vendor.adminlte.employee.edit',[])->with('user', $user);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("user"),
				]);
			}
    }

    public function show($id){
        $user = User::find($id);
			if(isset($user->_id)) {
				$setErrorsBag = "khong hien thi";
				return view('vendor.adminlte.employee.show',[])->with('user', $user);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("user"),
				]);
			}
    }
}
