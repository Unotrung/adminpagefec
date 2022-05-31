@extends('layouts.app')

@section('title', 'Edit Role')
@section('css')
<link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
{{-- <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css"> --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" 
   href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
@stop



@php
use App\Models\Role; 
$old = Role::find($role);
@endphp
@section('content_header')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Role</h1>
        <a href="{{route('roles.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
    </div>
@stop

@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-6">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Role</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('roles.update', 'id='.$role)}}">
                @csrf
                @method('POST')
                <div class="form-group row" style="padding: 20px">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <span style="color:red;">*</span>Display Name</label>
                        <input 
                            type="text" 
                            class="form-control form-control-user @error('name') is-invalid @enderror" 
                            id="display_name"
                            placeholder="Name" 
                            name="display_name" 
                            value="{{ $old['display_name'] }}">
                    </div>
                    {{-- Name --}}
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <span style="color:red;">*</span>Name</label>
                        <input 
                            type="text" 
                            class="form-control form-control-user @error('name') is-invalid @enderror" 
                            id="exampleName"
                            placeholder="Name" 
                            name="name" 
                            value="{{ $old['name'] }}">

                        @error('name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        Description</label>
                        <input 
                            type="text" 
                            class="form-control form-control-user @error('name') is-invalid @enderror" 
                            id="description"
                            placeholder="Name" 
                            name="description" 
                            value="{{ $old['description'] }}">
                    </div>
                    {{-- Guard Name --}}
                    <div class="col-sm-6 mb-3 mb-sm-0" style="display: none;">
                        <span style="color:red;">*</span>Guard Name</label>
                        <select class="form-control form-control-user @error('guard_name') is-invalid @enderror" name="guard_name">
                            <option value="web" {{old('guard_name') ? ((old('guard_name') == 'web') ? 'selected' : '') : (($old['guard_name'] == 'web') ? 'selected' : '')}}>Web</option>
                        </select>
                        @error('guard_name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>                  
                </div>
                
                <div class="form-group row">
                    <div class="card card-primary card-outline" style="width:100%">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-edit"></i>Assign Permissions</h6>
                        </div>
                        <div class="card-body">
                          <h6><b>Modules name : </b></h6>
                          <table>
                            @foreach ($modules as $module)
                                <tr style="border-bottom: 1px solid #eee">
                                
                                <th >
                                    {{$module->module}}
                                </th>
                                <td style="padding-left: 100px">
                                    <input type="hidden" name="{{$module->id}}" value="[]">
                                    {{-- @if($module->is_active != 0) --}}
                                        <input type="checkbox"  data-id="" name="{{$module->id}}"  class="js-switch" {{(in_array($roles->id, $module->is_active)) ? 'checked' : ''}} id="{{$module->id}}">
                                    {{-- @endif --}}
                                </td>
                                {{-- @foreach ($permissions as $permission) --}}
                                {{-- 
                                @if (strtolower($name_permission[0]) == strtolower($module->module)) --}}
                                    {{-- @if($permission_ids != null) --}}
                                            <td style="padding-left: 100px" >
                                                <div class="select2-purple my-purple">
                                                    <select class="select2"  multiple="multiple"  data-placeholder="" data-dropdown-css-class="select2-purple my-purple" style="width: 100%;" id="selectbox-{{$module->id}}" name="permission[]"  >
                                                        @foreach ($permissions as $permission)
                                                        <?php
                                                            $name_permission = explode("-", $permission->name);
                                                            $permission_ids = $roles->permission_ids;
                                                        ?>
<<<<<<< HEAD
                                                        {{-- @if($permission_ids != null) --}}
                                                            @if(($name_permission[0]) == strtolower($module->module))
                                                            <option value="{{$permission->id}}"  
                                                                {{ (in_array($permission->id, $permission_ids)) ?((($name_permission[0]) == strtolower($module->module))? "selected" : ""): "" }}>
                                                                {{$permission->name}}
                                                            </option>
                                                            @endif
                                                        {{-- @endif --}}
=======
                                                        @if(($name_permission[0]) == strtolower($module->module))
                                                        <option value="{{$permission->id}}"  
                                                            {{ ($permission_ids!== null && in_array($permission->id, $permission_ids)) ?((($name_permission[0]) == strtolower($module->module))? "selected" : ""): "" }}>
                                                            {{$permission->name}}
                                                        </option>
                                                        @endif
>>>>>>> 57d4e7d (update role edit)
                                                        @endforeach
                                                        
                                                    </select>
                                                </div>
                                            </td>
                                    {{-- @endif --}}
                                {{-- @endif --}}
                                {{-- @endforeach --}}
                            </tr>
                            @endforeach
                            
                          </table>
                        </div>
                        <!-- /.card -->
                    </div>
                      <!-- /.card -->
                </div> 
                {{-- Save Button --}}
                <div data-toggle="modal" data-target="#demoModal" class="btn btn-success btn-user btn-block" style="width:20%; display:block; margin: 0 auto;">
                    Update
                </div>
                <div class="modal" id="demoModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Do you want to update?  </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Yes</button>
                            <button type="button" class="btn" data-dismiss="modal">No</button>
                        </div>
                        </div>
                </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    @if(Session::has('success'))
      toastr.options =
      {
        "closeButton" : true,
        "progressBar" : true
      }
          toastr.success("{{ session('success') }}");
      @endif

  </script>

@endsection
@section('js')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="../../plugins/select2/js/select2.full.min.js"></script>

<style>
select:focus{
        outline: none;
    }
.overSelect {
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
}
</style>
<script>
$(document).ready(function()
{
  $('.js-switch').change(function () {
        status = $(this).prop('checked') === true ? 1 : 0;
        configId = this.id;
        if( status == 1)
        {        
            $("#selectbox-"+configId).prop('disabled', false);
        }
        else
        {
            $("#selectbox-"+configId).prop('disabled', true);
        }
        
    });
    var chekc_per =  $('.js-switch').val();
   
    $('.select2').select2()
// 
});


let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

elems.forEach(function(html) {
    let switchery = new Switchery(html,  { size: 'small' });
});

var boxes = $("input[type='checkbox']");
// Loop through each input box
$.each( boxes, function( key, value ) {
    // Check if the input box is checked
    if ($(this).prop('checked')) {
        // Input box is checked - Add anything you want to happen in the clause below
        var boxid = $(this).attr('id');
        $("#selectbox-"+boxid).prop('disabled', false);
        // console.log(boxid + ' is checked');
    } else {
        // Input box is not checked - Add anything you want to happen in the clause below
        var boxid = $(this).attr('id');
        $("#selectbox-"+boxid).prop('disabled', true);
        // var myString = boxid+'';
        
        // console.log(check);
        // console.log(boxid + ' is not checked');
    }
});

</script>

@stop