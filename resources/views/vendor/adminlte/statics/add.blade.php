@extends('layouts.app')

@section('title', 'Add Statics Page')
@section('css')
<link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.min.css">
@stop
@section('content_header')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Statics Page</h1>
        <a href="{{route('statics.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
    </div>
@stop
@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add Statics Page</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('statics.store')}}" enctype="multipart/form-data">
                @csrf
                <!-- <div class="form-group row"> -->
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Page name</label>
                        <div class="col-sm-10">
                        <input type="string" class="form-control" name="Pagename_Create" placeholder="Pagename" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Type</label>
                        <div class="col-sm-10">
                        <input type="string" class="form-control" name="Type_Create" placeholder="Type" >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-10">
                            <select type="string" class="form-control" name="Status_Create" placeholder="Status" >
                                <option value="active">Active</option>
                              <option value="unactive">Unactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Content</label>
                        <div class="col-sm-10">
                            <textarea name="Content_Create" id="summernote" cols="100" rows="10">Place <em>some</em> <u>text</u> <strong>here</strong></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Post</label>
                        <div class="col-sm-10">
                        <input type="String" class="form-control" name="Post_Create" placeholder="Post" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Language</label>
                        <div class="col-sm-10">
                        <input type="string" class="form-control" name="Language_Create" placeholder="Language" >
                        </div>
                    </div>
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
    const chooseFile = document.getElementById("file_Edit_Statics");
    const imgPreview = document.getElementById("img-preview");

    chooseFile.addEventListener("change", function () {
      getImgData();
    });

    function getImgData() {
      const files = chooseFile.files[0];
      if (files) {
        const fileReader = new FileReader();
        fileReader.readAsDataURL(files);
        fileReader.addEventListener("load", function () {
          imgPreview.innerHTML = '<img class=" col-md-5 fvalue" src="' + this.result + '" />';
        });
      }
    }
</script>
@stop
