@extends('layouts.app')

@section('title', 'Add Roles')


@section('content_header')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Role</h1>
        <a href="{{route('roles.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
    </div>
@stop
@section('content')
    <!-- DataTales Example -->
    <div class="card shadow md-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add New Role</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('roles.store')}}">
                @csrf
                <div class="form-group row">
                    <div class="input-group mb-3 ">
                        <input 
                            type="text" 
                            class="form-control form-control-user @error('name') is-invalid @enderror" 
                            id="display_name"
                            placeholder="Display Name" 
                            name="displayName" 
                            value="" autofocus>
                            <div class="input-group-append">
						        <div class="input-group-text">
                                <span class="fas fa-user-tag "></span>
                            </div>
                        </div>
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
                            <div class="input-group-append">
						        <div class="input-group-text">
                                <span class="fas fa-signature "></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3 ">
                        <input 
                            type="text" 
                            class="form-control form-control-user @error('name') is-invalid @enderror" 
                            id="description"
                            placeholder="Description" 
                            name="description" 
                            value="">
                            <div class="input-group-append">
						        <div class="input-group-text">
                                <span class="fas fa-scroll"></span>
                            </div>
                        </div>
                    </div>


                    {{-- Guard Name --}}
                    <div class="col-sm-6 mb-3 mb-sm-0 hidden" style="display: none;">
                        <span style="color:red;">*</span>Guard Name</label>
                        <select class="form-control form-control-user @error('guard_name') is-invalid @enderror" name="guard_name">
                            <option selected disabled value="web" selected>Web</option>
                        </select>
                        @error('guard_name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                </div>

                {{-- Save Button --}}
                <div data-toggle="modal" data-target="#demoModal" class="btn btn-success btn-user btn-block" style="width:20%; display:block; margin: 0 auto;">
                    Save
                </div>
                <div class="modal" id="demoModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Do you want to add a new role?  </h4>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $('#display_name').on('change', function(){
        console.log($('#display_name').val());
        $('#exampleName').val($('#display_name').val());
    });
});
</script>