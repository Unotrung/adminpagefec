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
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Page Name</label>
                        <div class="col-sm-10">
                          <input disabled="disabled" type="String" class="form-control" name="Pagename_Edit" placeholder=" show Pagename" value="{{$static->Pagename}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Type</label>
                        <div class="col-sm-10">
                          <input disabled="disabled" type="String" class="form-control" name="Type_Edit" placeholder=" show Type" value="{{$static->Type}}">
                        </div>
                      </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                      <input type="String" class="form-control" name="Title_Edit" placeholder="Title" value="{{$static->Title}}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                      <textarea type="String" class="form-control" name="Description_Edit" id="summer_descrip" >
                      {!!$static->Description!!}
                      </textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Post</label>
                    <div class="col-sm-10">
                      <textarea type="String" class="form-control" name="Post_Edit" id="summer1_descrip" >
                      {!!$static->Post!!}
                      </textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Language</label>
                    <div class="col-sm-10">
                            <select  type="string" class="form-control" name="Language_Create" placeholder="Language" value="{{$static->Language}}" >
                              <option >Choose Language</option>
                              <option >VNI</option>
                              <option >EN</option>
                            </select>
                    </div>
                  </div>

                  {{-- <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">URL</label>
                    <div class="col-sm-10">
                      <input type="String" class="form-control" name="Url_Edit" placeholder="Title" value="{{$static->URL}}">
                    </div>
                  </div> --}}
                  <input type="hidden" class="form-control" name="Image_Create" placeholder="Image_create" value="{{$static->Image}}">
                  {{-- <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Image</label>
                    <div class="col-sm-10">
                      <div id="img-preview" style="padding-bottom: 10px;" >
                        <img class=" col-md-6 fvalue" src="{{ asset("./ImagesStatics/$static->Image") }} " alt="">
                      </div>
                      <label for="file_Edit_Statics" class="btn btn-primary col-md-6 fvalue">Change image</label>
                      <input id="file_Edit_Statics" name="Img_Edit" placeholder="Image" style="visibility:hidden;" type="file">
                    </div>
                  </div> --}}
                  {{-- <button type="submit" class="btn btn-success btn-user btn-block" style="width: 100px;margin: auto;"> --}}
                  <div data-toggle="modal" data-target="#demoModal" class="btn btn-success btn-user btn-block" style="width:100px;margin: auto;">
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


</script>

@endsection
@section('js')
<script src="../../plugins/summernote/summernote-bs4.min.js"></script>


<script>
    $(function () {
      $('#summer_descrip').summernote();
    })
    $(function () {
      $('#summer1_descrip').summernote();
    })
</script>

{{-- <script>
    $(document).ready(function() {
      $('#summernote').summernote({
        height: 200,
        onImageUpload: function(files, editor, welEditable) {
          sendFile(files[0], editor, welEditable);
        }
      });

      function sendFile(file, editor, welEditable) {
        data = new FormData();
        data.append("file", file);
        $.ajax({
          data: data,
          type: "POST",
          url: "Your URL POST (php)",
          cache: false,
          contentType: false,
          processData: false,
          success: function(url) {
            editor.insertImage(welEditable, url);
          }
        });
      }
    });
    </script> --}}

@stop
