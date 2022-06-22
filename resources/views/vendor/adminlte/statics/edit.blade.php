@extends('layouts.app')

@section('title', 'Edit Statics')

@php
use App\Models\Statics;
$static = Statics::find($statics);
@endphp
@section('css')
<link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.min.css">
@stop
@section('content_header')
<div class="container-fluid">
<div class="row mb-2">
<div class="col-sm-11">
            <h2 class="h3 mb-0 text-gray-800">Edit Statics </h2>
</div>
<div class="col-sm-1">
            <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="{{ route('statics.index') }}"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
        </div>
</div>
@stop
@section('content')
    <!-- DataTales Example -->
    <div class="col-md-12">
      <div class="card">
                <div class="card-body">
                  <form method="POST" action="{{route('statics.update', 'id='.$statics)}}" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                      <input type="String" class="form-control" name="Title_Edit" placeholder="Title" value="{{$static->Title}}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                      <input type="String" class="form-control" name="Description_Edit" placeholder="Title" value="{{$static->Description}}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Content</label>
                    <div class="col-sm-10">
                      <textarea type="String" class="form-control" name="Content_Edit" id="summer_descrip" >
                      {!!$static->Content!!}
                      </textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Author</label>
                    <div class="col-sm-10">
                      <input type="String" class="form-control" name="Author_Edit" placeholder="Title" value="{{$static->Author}}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">URL</label>
                    <div class="col-sm-10">
                      <input type="String" class="form-control" name="Url_Edit" placeholder="Title" value="{{$static->URL}}">
                    </div>
                  </div>
                  <input type="hidden" class="form-control" name="Image_Create" placeholder="Image_create" value="{{$static->Image}}">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Image</label>
                    <div class="col-sm-10">
                      <div id="img-preview" style="padding-bottom: 10px;" >
                        <img class=" col-md-6 fvalue" src="{{ asset("./ImagesStatics/$static->Image") }} " alt="">
                      </div>
                      <label for="file_Edit_Statics" class="btn btn-primary col-md-6 fvalue">Change image</label>
                      <input id="file_Edit_Statics" name="Img_Edit" placeholder="Image" style="visibility:hidden;" type="file">
                    </div>
                  </div>
                  <div data-toggle="modal" data-target="#demoModal" class="btn btn-success btn-user btn-block" style="width:100%">
                    Submit
                  </div>

                  <div class="modal" id="demoModal">
                    <div class="modal-dialog">
                      <div class="modal-content">
                      <!-- Modal Header -->
                        <div class="modal-header">
                          <h4 class="modal-title">Do you want to edit statics?  </h4>
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
</div>
<script>
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
      imgPreview.innerHTML = '<img class=" col-md-10 fvalue" src="' + this.result + '" />';
    });
  }
}
</script>

@endsection
@section('js')
<script src="../../plugins/summernote/summernote-bs4.min.js"></script>
<script>
    $(function () {
      $('#summer_descrip').summernote();
    })
</script>
@stop
