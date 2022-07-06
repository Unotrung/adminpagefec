@extends('layouts.app')

@section('title', 'Edit News')

@php
use App\Models\News;
$new = News::find($news);
@endphp
@section('css')
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
<link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.min.css">
@stop
@section('content_header')
<div class="container-fluid">
<div class="row mb-2">
<div class="col-sm-11">
            <h2 class="h3 mb-0 text-gray-800">Edit News </h2>
</div>
<div class="col-sm-1">
            <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="{{ route('news.index') }}"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
        </div>
</div>
@stop
@section('content')
    <!-- DataTales Example -->
    <div class="col-md-12">
      <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('news.update', 'id='.$news)}}" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Language</label>
                            <div class="col-sm-10">
                                <select  type="string" class="form-control" name="Language_Edit" id="examplelang" style="border-left: 2px solid red;" placeholder="Language" value="{{$new->Language}}">
                                    {{-- <option> Choose Language... </option> --}}
                                    <option value="{{$new->Language}}" selected>{{$new->Language}}</option>
                                  </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-10">
                            <input type="String" class="form-control" name="Title_Edit" id="exampletitle" style="border-left: 2px solid red;" placeholder="Title" value="{{$new->Title}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                            <textarea type="String" class="form-control" name="Description_Edit" id="summer_descrip" >
                            {!!$new->Description!!}
                            </textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Body</label>
                            <div class="col-sm-10">
                            <input type="String" class="form-control" name="Body_Edit" placeholder="Title" value="{{$new->Body}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Order</label>
                            <div class="col-sm-10">
                                <select  type="String" class="form-control" name="Order_Edit" placeholder="Order" value="{{$new->Order}}">
                                    {{-- <option> Choose Language... </option>  selected='{{$new->Order}} --}}
                                    {{-- <option value="{{$new->Order}}" selected>{{$new->Order}}</option> --}}
                                    {{-- if($new->Order){
                                        <option value="{{$new->Order}}" selected={{$new->Order}} >{{$new->Order}}</option>
                                    } --}}
                                        <option {{$new->Order === "1" ? "selected" : ""}} value="1">1</option>
                                        <option {{$new->Order === "2" ? "selected" : ""}} value="2">2</option>
                                        <option {{$new->Order === "3" ? "selected" : ""}} value="3">3</option>

                                  </select>
                            </div>
                        </div>
                        <div class="btn btn-success btn-user btn-block" onClick="btnSubmit(this.value)" style="width:100px;margin: 0 auto;">
                            Submit
                        </div>

                        <div class="modal" id="demoModal">
                            <div class="modal-dialog">
                            <div class="modal-content">
                            <!-- Modal Header -->
                                <div class="modal-header">
                                <h4 class="modal-title">Do you want to edit new?  </h4>
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
{{-- <script>
const chooseFile = document.getElementById("file_Edit_News");
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
</script> --}}

@endsection
@section('js')
<script src="../../plugins/summernote/summernote-bs4.min.js"></script>
<script>
    $(function () {
      $('#summer_descrip').summernote();
    })

    function btnSubmit(){
		var Title = $("#exampletitle").val();
		var Language = $("#examplelang").val();
        if(Title.length === 0){
            toastr["error"]("Please Input Title!")
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
		if(Title.length > 0)
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
<!-- SweetAlert2 -->
<script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="../../plugins/toastr/toastr.min.js"></script>
{{-- <script src="toastr.js"></script> --}}
@stop
