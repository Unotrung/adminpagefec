@extends('layouts.app')

@section('title', 'Add Permission')

@section('content_header')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Permission</h1>
        <a href="{{route('permission.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
    </div>
@stop
@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add New Permission</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('permission.store')}}">
                @csrf
                <div class="form-group row">

                <div class="input-group mb-3 ">
                        <input 
                            type="text" 
                            class="form-control form-control-user @error('name') is-invalid @enderror" 
                            id="display_name"
                            placeholder="Display Name" 
                            name="display_name" 
                            value="{{ old('display_name') }}">

                        @error('name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    {{-- Name --}}
                    <div class="input-group mb-3 ">
                        <input 
                            type="text" 
                            class="form-control form-control-user @error('name') is-invalid @enderror" 
                            id="exampleName"
                            placeholder="Name" 
                            name="name" 
                            value=""
                            readonly>

                        @error('name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="input-group mb-3 ">
                        <input 
                            type="text" 
                            class="form-control form-control-user @error('name') is-invalid @enderror" 
                            id="description"
                            placeholder="Description" 
                            name="description" 
                            value="">

                        @error('name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="col-sm-6 mb-3 mb-sm-0" style="display: none;">
                        <span style="color:red;">*</span>Guard Name</label>
                        <select class="form-control form-control-user @error('guard_name') is-invalid @enderror" name="guard_name">
                            <option value="web" selected>Web</option>
                        </select>
                        @error('guard_name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                </div>

                {{-- Save Button --}}
                <button type="submit" class="btn btn-success btn-user btn-block" style="width:20%; display:block; margin: 0 auto;">
                    Save
                </button>

            </form>
        </div>
    </div>

</div>


@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $('#display_name').on('change', function(){
        console.log();
        $input_value = $('#display_name').val();
        if($input_value.includes(" "))
        {
            $input_value = $input_value.replaceAll(" ","-");
            $input_value = $input_value.toLowerCase();
        }
        else{
            $input_value = $input_value.toLowerCase();
        }
        $('#exampleName').val($input_value);
    });
});
</script>