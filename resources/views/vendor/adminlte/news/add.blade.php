@extends('layouts.app')

@section('title', 'Add News')
@section('css')
<link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.min.css">
@stop
@section('content_header')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add News</h1>
        <a href="{{route('news.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
    </div>
@stop
@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add News</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('news.store')}}" enctype="multipart/form-data" >
                @csrf
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Language</label>
                    <div class="col-sm-10">
                        <select type="string" class=" form-control @error('Language_Create') is-invalid @enderror " name="Language_Create"  id="examplelang" placeholder="Language"  style="border-left: 2px solid red;" >
                            <option value="">Choose Language</option>
                            <option value="VI">VI</option>
                            <option value="EN">EN</option>
                          </select>

                    @error('Language_Create')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                </div>

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                        <input type="string" class="form-control @error('Title_Create') is-invalid @enderror"  name="Title_Create" id="exampletitle" placeholder="Title"   style="border-left: 2px solid red;">
                        @error('Title_Create')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                </div>
                <!-- <div class="form-group row"> -->
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                        <input type="string" class="form-control" name="Description_Create" placeholder="Description" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Body</label>
                        <div class="col-sm-10">
                            <textarea name="Body_Create" id="summernote" cols="100" rows="10">Place <em>some</em> <u>text</u> <strong>here</strong></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Order</label>
                        <div class="col-sm-10">
                            <select type="string" class="form-control" name="Order_Create" placeholder="Order" >
                                <option value="">Choose Order</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                              </select>
                        </div>
                    </div>

                {{-- Save Button --}}
                <button type="submit" class="btn btn-success btn-user btn-block" style="width: 100px;margin: auto;">
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
