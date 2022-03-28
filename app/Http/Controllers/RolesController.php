<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maklad\Permission\Models\Role;
use Maklad\Permission\Models\Permission;
use App\Models\Role as DB;
use DataTables;

class RolesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
         $this->middleware('auth');
    //     $this->middleware(['can:read'],['only' => ['index']]);
    //     $this->middleware('permission:permission-list|permission-create|permission-edit|permission-delete', ['only' => ['index']]);
    //     $this->middleware('permission:permission-create', ['only' => ['create','store']]);
    //     $this->middleware('permission:permission-edit', ['only' => ['edit','update']]);
    //     $this->middleware('permission:permission-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('vendor.adminlte.roles.index');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vendor.adminlte.roles.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = new Role;
        $role->name = $request->name;
        $role->guard_name = $request->guard_name;

        $role->save();

        return view("vendor.adminlte.roles.index");
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permissions = Permission::All();
        return view('vendor.adminlte.roles.edit', ['role' => $role->id, 'permissions'=>$permissions]);
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
                'name' => 'required',
                'guard_name' => 'required'
            ]);
            $id = $request['id'];
            $role = Role::find($id);
            $role->name = $request->name;
            $role->guard_name = $request->guard_name;
            $rPer = $request->permission;
            $role->revokePermissionTo(Permission::All());
            foreach ($rPer as $per){
                $role->givePermissionTo(Permission::find($per));
            }

            $role->save();
            
        return redirect()->route('roles.index')->with('success','Permissions updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();
        return redirect()->route('roles.index')->with('Role deleted successfull');
    }

    public function dtajax(Request $request){
        if ($request->ajax()) {
        $out =  DataTables::of(Role::All())->make(true);
           $data = $out->getData();
           for($i=0; $i < count($data->data); $i++) {
               $output = '';
               //$output .= ' <a href="'.url(route('roles.show',['id'=>$data->data[$i]->_id])).'" class="btn btn-info btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-eye"></i></a>';
                $output .= ' <a href="'.url(route('roles.edit',['id'=>$data->data[$i]->_id])).'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
               $output .= ' <a href="'.url(route('roles.delete',['id'=>$data->data[$i]->_id])).'" class="btn btn-danger btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-ban"></i></a>';
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
