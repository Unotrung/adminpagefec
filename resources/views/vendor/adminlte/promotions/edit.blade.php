@extends('layouts.app')
@section('title', 'Edit Promotion')

@section('content_header')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Promotion</h1>
        <a href="{{route('promotions.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
    </div>
@stop
@section('content')   
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Promotion</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('promotions.update', 'id='.$promotion['id'])}}">
                @csrf
                @method('POST')
                <div class="form-group row">
                    {{-- Title --}}
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <span style="color:red;">*</span>Title</label>
                        <input 
                            type="text" 
                            class="form-control form-control-user @error('name') is-invalid @enderror" 
                            id="title"
                            placeholder="Name" 
                            name="title" 
                            value="{{ $promotion['Title'] }}">
                    </div>
                    {{-- Description --}}
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <span></span>Description</label>
                        <input 
                            type="text" 
                            class="form-control form-control-user @error('name') is-invalid @enderror" 
                            id="description"
                            placeholder="Name" 
                            name="description" 
                            value="{{ $promotion['Description'] }}">
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