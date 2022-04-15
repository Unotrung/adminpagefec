@extends('layouts.app')

@section('title', 'Edit Role')


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
                <div class="form-group row">
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
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Assign Permissions</h6>
                    </div>
                    <table class="table table-sm">
                        <thead>
                            <tr>
                            {{-- <th>Modules</th>
                            <th>View</th> --}}
                            @foreach ($modules as $module)
                            <?php
                                    if (!str_starts_with ($module->module,'Super')) 
                                        { ?>
                                            <th>{{$module->module}}</th>
                                        <?php 
                                        }
                                ?>
                            
                                
                            
                            @endforeach
                        </tr>
                        </thead>
                        @foreach ($permissions as $permission)
                        <tbody>
                                <?php
                                    if (str_starts_with ($permission->name,'customer')) 
                                        { ?>
                                            <td class=""><div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" type="checkbox" id="{{$permission->id}}" value="{{$permission->id}}" name="permission[]" > 
                                                <label for="{{$permission->id}}" class="custom-control-label">{{$permission->name}}</label>
                                              </div></td>
                                        <?php 
                                        }
                                ?>
                                <?php
                                if (str_starts_with ($permission->name,'customer')) 
                                    { ?>
                                        <td class=""><div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" id="{{$permission->id}}" value="{{$permission->id}}" name="permission[]" > 
                                            <label for="{{$permission->id}}" class="custom-control-label">{{$permission->name}}</label>
                                          </div></td>
                                    <?php 
                                    }
                            ?>
                            <?php
                            if (str_starts_with ($permission->name,'customer')) 
                                { ?>
                                    <td class=""><div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="{{$permission->id}}" value="{{$permission->id}}" name="permission[]" > 
                                        <label for="{{$permission->id}}" class="custom-control-label">{{$permission->name}}</label>
                                      </div></td>
                                <?php 
                                }
                        ?>
                        <?php
                        if (str_starts_with ($permission->name,'customer')) 
                            { ?>
                                <td class=""><div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="{{$permission->id}}" value="{{$permission->id}}" name="permission[]" > 
                                    <label for="{{$permission->id}}" class="custom-control-label">{{$permission->name}}</label>
                                  </div></td>
                            <?php 
                            }
                    ?>
                            
                        </tbody>
                        @endforeach
                        {{-- @foreach ($permissions as $permission)
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" id="{{$permission->id}}" value="{{$permission->id}}" name="permission[]" > 
                          <label for="{{$permission->id}}" class="custom-control-label">{{$permission->name}}</label>
                        </div>
                        
                        @endforeach --}}
                    </table>
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
                            <h4 class="modal-title">Do you want to edit role?  </h4>
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


@endsection