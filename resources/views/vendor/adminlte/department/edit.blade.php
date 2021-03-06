@extends('layouts.app')

@section('title', 'Edit Department')

@section('content_header')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Department</h1>
        <a href="{{route('department.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Back </a>
    </div>
@stop 
@section('content')  
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Department</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('department.update')}}">
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
                            value="{{$department['name']}}">

                        @error('name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    {{-- Phone --}}
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <span></span>Phone</label>
                        <input 
                            type="text" 
                            class="form-control form-control-user @error('name') is-invalid @enderror" 
                            id="phone"
                            placeholder="Phone" 
                            name="phone" 
                            value="{{$department['phone']}}">

                        @error('name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    {{-- Website --}}
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <span></span>Website</label>
                        <input 
                            type="text" 
                            class="form-control form-control-user @error('name') is-invalid @enderror" 
                            id="website"
                            placeholder="www.example.com" 
                            name="website" 
                            value="{{$department['website']}}">

                        @error('name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    {{-- Email --}}
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <span></span>Email</label>
                        <input 
                            type="text" 
                            class="form-control form-control-user @error('name') is-invalid @enderror" 
                            id="email"
                            placeholder="example@example.com" 
                            name="email" 
                            value="{{$department['email']}}">

                        @error('name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    {{-- Address --}}
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <span></span>Address</label>
                        <input 
                            type="text" 
                            class="form-control form-control-user @error('name') is-invalid @enderror" 
                            id="address"
                            placeholder="" 
                            name="address" 
                            value="{{$department['address']}}">

                        @error('name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    {{-- Description --}}
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <span></span>Description</label>
                        <input 
                            type="text" 
                            class="form-control form-control-user @error('name') is-invalid @enderror" 
                            id="description"
                            placeholder="" 
                            name="description" 
                            value="{{$department['description']}}">

                        @error('name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <input type="hidden" name="id" value="{{$department['id']}}">             
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