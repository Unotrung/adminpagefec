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
        <a href="{{route('permission.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
    </div>
@stop

@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Role</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('roles.update', 'id='.$role)}}">
                @csrf
                @method('POST')
                <div class="form-group row">

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
                    {{-- Guard Name --}}
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <span style="color:red;">*</span>Guard Name</label>
                        <select class="form-control form-control-user @error('guard_name') is-invalid @enderror" name="guard_name">
                            <option selected disabled>Select Guard Name</option>
                            <option value="web" {{old('guard_name') ? ((old('guard_name') == 'web') ? 'selected' : '') : (($old['guard_name'] == 'web') ? 'selected' : '')}}>Web</option>
                            <option value="api" {{old('guard_name') ? ((old('guard_name') == 'api') ? 'selected' : '') : (($old['guard_name'] == 'api') ? 'selected' : '')}}>Api</option>
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
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        @foreach ($permissions as $permission)
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" id="{{$permission->id}}" value="{{$permission->id}}" name="permission[]" @if($old->hasPermissionTo($permission->name)) checked @endif >
                          <label for="{{$permission->id}}" class="custom-control-label">{{$permission->name}}</label>
                        </div>
                        @endforeach
                    </div>
                </div>
                {{-- Save Button --}}
                <button type="submit" class="btn btn-success btn-user btn-block">
                    Update
                </button>
            </form>
        </div>
    </div>
</div>


@endsection