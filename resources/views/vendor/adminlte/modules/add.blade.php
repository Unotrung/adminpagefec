@extends('layouts.app')

@section('title', 'Add Module')
@section('css')
<link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.min.css">
@stop
@section('content_header')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Module</h1>
        <a href="{{route('modules.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
    </div>
@stop
@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add Module</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('modules.store')}}">
                @csrf
                <!-- <div class="form-group row"> -->
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Module</label>
                        <div class="col-sm-10">
                        <input type="string" class="form-control" name="module" placeholder="Module Name" >
                        </div>
                    </div>
                <!-- </div> -->
                {{-- Save Button --}}
                <button type="submit" class="btn btn-success btn-user btn-block">
                    Save
                </button>

            </form>
        </div>
    </div>

</div>


@endsection
@section('js')
<script src="../../plugins/summernote/summernote-bs4.min.js"></script>
<script>
    $(function () {
      $('#summernote').summernote();
    })
</script>
@stop
