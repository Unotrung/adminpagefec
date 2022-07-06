@extends('layouts.app')

@section('title', 'Edit Statics')

@php
use App\Models\Statics;
$static = Statics::find($statics);
@endphp
@section('css')
<link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.min.css">
<!-- SweetAlert2 -->
<link rel="stylesheet" href="../../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<!-- Toastr -->
<link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
{{-- <link href="toastr.css" rel="stylesheet"/> --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css"
   href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
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
                  <form method="POST" action="{{route('statics.update', 'id='.$statics)}}" >
                    {{-- enctype="multipart/form-data" --}}
                    @csrf
                    @method('POST')
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Page Name</label>
                        <div class="col-sm-10">
                          <input readonly type="String" class="form-control" name="Pagename_Edit" placeholder=" show Pagename" value="{{$static->Pagename}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Type</label>
                        <div class="col-sm-10">
                          <input readonly type="String" class="form-control" name="Type_Edit" placeholder=" show Type" value="{{$static->Type}}">
                        </div>
                      </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                      <input type="String" class="form-control" name="Title_Edit" placeholder="Title" id="exampletitle" style="border-left: 2px solid red;" value="{{$static->Title}}">
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
                            <select  type="string" class="form-control" name="Language_Edit" placeholder="Language" value="{{$static->Language}}">
                              {{-- <option> Choose Language... </option> --}}
                              <option value="{{$static->Language}}" selected>{{$static->Language}}</option>
                            </select>
                    </div>
                  </div>

                  {{-- <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">URL</label>
                    <div class="col-sm-10">
                      <input type="String" class="form-control" name="Url_Edit" placeholder="Title" value="{{$static->URL}}">
                    </div>
                  </div> --}}
                  {{-- <input type="hidden" class="form-control" name="Image_Create" placeholder="Image_create" value="{{$static->Image}}"> --}}
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
                  <div class="btn btn-success btn-user btn-block" onClick="btnSubmit(this.value)" style="width:100px;margin: 0 auto;">
                    Submit
                  </div>

                  <div class="modal" id="demoModal">
                    <div class="modal-dialog">
                      <div class="modal-content">
                      <!-- Modal Header -->
                        <div class="modal-header">
                          <h4 class="modal-title">Do you want to edit news?  </h4>
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

    function btnSubmit(){
		var Title = $("#exampletitle").val();
		var Post = $("#summer1_descrip").val();
        if(Title.length === 0  && Post.length > 0){
            toastr["error"]("Please Input Title!")
        }
        if(Title.length === 0  && Post.length === 0){
            toastr["error"]("Please Input Title, Post!")
        }
        if(Title.length > 0  && Post.length === 0){
            toastr["error"]("Please Input Post!")
        }
        toastr.options = {
			"closeButton": false,
			"debug": true,
			"newestOnTop": false,
			"progressBar": false,
			"positionClass": "toast-top-right",
			"preventDuplicates": false,
			"onclick": null,
			"showDuration": "300",
			"hideDuration": "1000",
			"timeOut": "5000",
			"extendedTimeOut": "1000",
			"showEasing": "swing",
			"hideEasing": "linear",
			"showMethod": "fadeIn",
			"hideMethod": "fadeOut"
		}
		if(Title.length > 0 && Post.length > 0)
		{
			// data-toggle="modal" data-target="#confirmModal"
			$("#demoModal").modal("show");
			formChanged = false;
		}

	}

    var myForms = document.querySelectorAll('.card-body input')
	  var mySelects = document.querySelectorAll('.card-body select')
	  for (let myForm of myForms)
	  {
	  	myForm.addEventListener('change', function() {formChanged = true});
		window.addEventListener('beforeunload', (event) => {
		if (formChanged) {
			event.returnValue = 'You have unfinished changes!';
		}
		});
	}
	for (let mySelect of mySelects)
	  {
		mySelect.addEventListener('change', function() {formChanged = true});
		window.addEventListener('beforeunload', (event) => {
		if (formChanged) {
			event.returnValue = 'You have unfinished changes!';
		}
		});
	}

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
<!-- SweetAlert2 -->
<script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="../../plugins/toastr/toastr.min.js"></script>
{{-- <script src="toastr.js"></script> --}}
@stop
