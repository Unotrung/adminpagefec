<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maklad\Permission\Models\Role;
use Maklad\Permission\Models\Permission;
use App\Models\Role as DB;

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
        // DB::beginTransaction();
        // try {
        //     $request->validate([
        //         'name' => 'required',
        //         'guard_name' => 'required'
        //     ]);
    
        //     Permission::create($request->all());

        //     DB::commit();
        //     return redirect()->route('permission.index')->with('success','Permissions created successfully.');
        // } catch (\Throwable $th) {
        //     DB::rollback();
        //     return redirect()->route('permission.add')->with('error',$th->getMessage());
        // }
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
        //DB::beginTransaction();
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
        DB::beginTransaction();
        try {
    
            Role::whereId($id)->delete();
            
            DB::commit();
            return redirect()->route('roles.index')->with('success','Permissions deleted successfully.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('roles.index')->with('error',$th->getMessage());
        }
    }
}
