<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\DB;
//use Maklad\Permission\Models\Role;
use App\Models\Provider;
use DataTables;

class DepartmentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     $this->middleware('permission:permission-list|permission-create|permission-edit|permission-delete', ['only' => ['index']]);
    //     $this->middleware('permission:permission-create', ['only' => ['create','store']]);
    //     $this->middleware('permission:permission-edit', ['only' => ['edit','update']]);
    //     $this->middleware('permission:permission-delete', ['only' => ['destroy']]);
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $permissions = Permission::paginate(10);

        return view('vendor.adminlte.department.index');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vendor.adminlte.department.add');
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
        $department = new Provider;
        $department->name = $request->name;
        $department->phone = $request->phone;
        $department->website = $request->website;
        $department->email = $request->email;
        $department->address = $request->address;
        $department->description = $request->description;
    

        $department->save();

        return view("vendor.adminlte.department.index");
        
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
        $role = Provider::find($id);
        // $permission = Permission::whereId($id)->first();
        return view('vendor.adminlte.department.edit', ['permission' => $role->id]);
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
            $role = Provider::Where($id)->first();
            $role->name = $request->name;
            $role->guard_name = $request->guard_name;
            $role->id = $id;
            $role->save();
            
        return redirect()->route('department.index')->with('success','Permissions updated successfully.');
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
    
            Provider::whereId($id)->delete();
            
            DB::commit();
            return redirect()->route('department.index')->with('success','Permissions deleted successfully.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('department.index')->with('error',$th->getMessage());
        }
    }
}
