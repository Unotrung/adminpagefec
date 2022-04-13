<?php

namespace App\Http\Controllers;

use App\Models\Modules;
use DataTables;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maklad\Permission\Models\Role;
use Maklad\Permission\Models\Permission;

class ModuleController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::all();
        $roles = Role::all();
        return view('vendor.adminlte.modules.index',['permissions'=>$permissions,'roles'=>$roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vendor.adminlte.modules.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $modules = new Modules;
        $modules->module = $request->module;
        $modules->save();
        return redirect()->route("modules.index")->with('Create news successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $module = Modules::find($id);
			if(isset($module->_id)) {
				$setErrorsBag = "khong hien thi";
				return view('vendor.adminlte.modules.show',[])->with('modules', $module);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("news"),
				]);
			}
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $modules = Modules::find($id);
        return view('vendor.adminlte.modules.edit', ['module' => $modules->id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'module' => 'required',
            'role' => 'required'
        ]);
        $id = $request['id'];
        $module = Modules::find($id);
        $module->module = $request->module;
        if($request->role != null ){
            $role = Role::Where('name','=',$request->role)->get();
            $module->assignRole($role[0]['name']);
        }
        $module->save();
            
        return redirect()->route('modules.index')->with('success','modules updated successfully.');
    }

    public function givePermissionTo(Request $request)
    {
        $id = $request->id;
        $role = Role::find($id);
        $permissions = $request->permissions;
        foreach ($permissions as $ele){
            $is_exist = Permission::firstOrCreate(['name' => $ele]);
            $role->givePermissionTo($is_exist);
        }
        return redirect()->route('modules.index');
    }

    public function getAllPermissions(Request $request ){
        $id = $request->id;
        print_r(Permission::with('roles')->find($id));
        return false;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $module = Modules::find($id);
        $module->is_delete = 1;
        $module->save();
        return redirect()->route('modules.index')->with('Module deleted successfull');
    }

    public function dtajax(Request $request){
        if ($request->ajax()) {
           $out =  Datatables::of(Modules::whereNull("is_delete")->get())->make(true);
           $data = $out->getData();
           for($i=0; $i < count($data->data); $i++) {
               $output = '';
               //$output .= ' <a href="'.url(route('modules.show',['id'=>$data->data[$i]->_id])).'" class="btn btn-info btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-eye"></i></a>';
                //$output .= ' <a href="'.url(route('modules.edit',['id'=>$data->data[$i]->_id])).'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
               //$output .= ' <a href="'.url(route('modules.delete',['id'=>$data->data[$i]->_id])).'" class="btn btn-danger btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-ban"></i></a>';
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
            }
           $out->setData($data);
           return $out;
       }
   }
}

