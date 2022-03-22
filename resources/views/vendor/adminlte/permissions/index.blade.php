@extends('layouts.app')

@section('title', 'Permissions')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Permissions</h1>
        <a href="{{route('permission.add')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus"></i> Add New
        </a>
    </div>

   
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Permissions</h6>
            
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="40%">Name</th>
                            <th width="40%">Guard Name</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                        <?php
                        use App\Models\Permission;
                        $data = Permission::Where('_id','!=',0)->get();
                        $count = 0;
                       foreach ($data as $permission){
                        $id = $permission['_id'];
                       ?>
                            <tbody>
                           <tr>
                               <td><?php echo $permission['name']?></td>
                               <td><?php echo $permission['guard_name']?></td>
                               <td style="display: flex">
                                   <a href="{{route('permission.edit',$id)}}" class="btn btn-primary m-2">
                                        <i class="fa fa-pen"></i>
                                   </a>
                                   <form method="POST" action="">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger m-2" type="submit">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                   </form>
                               </td>
                           </tr>
                    </tbody>
                    <?php 
                  $count = $count + 1;
                    }?> 
                </table>

                {{$permissions ?? '' ?? ''->links()}}
            </div>
        </div>
    </div>

</div>


@endsection