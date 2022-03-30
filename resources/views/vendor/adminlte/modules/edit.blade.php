@extends('layouts.app')

@section('title', 'Edit Module')


@php
$old = App\Models\Modules::find($module);
@endphp
@section('content_header')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Module</h1>
        <a href="{{route('modules.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
    </div>
@stop

@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Module</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('modules.update', 'id='.$module)}}">
                @csrf
                @method('POST')
                <div class="form-group row">

                    {{-- Name --}}
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <span style="color:red;">*</span>Module</label>
                        <input 
                            type="text" 
                            class="form-control form-control-user @error('name') is-invalid @enderror" 
                            id="exampleName"
                            placeholder="Name" 
                            name="module" 
                            value="{{ $old['module'] }}">

                        @error('name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>              
                </div>
                <div class="form-group row">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Assign Role</h6>
                    </div>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        @foreach (App\Models\Role::all() as $role)
                            @if( $role['name'] != 'super admin' )
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="{{$role->id}}" value="{{$role->name}}" name="role" >
                                    <label for="{{$role->id}}" class="custom-control-label">{{$role->name}}</label>
                                </div>
                        @endif
                        @endforeach
                    </div>
                </div>
                {{-- Save Button --}}
                <button type="submit" class="btn btn-success btn-user btn-block" style="width:20%; display:block; margin: 0 auto;">
                    Update
                </button>
            </form>
        </div>
    </div>
</div>


@endsection