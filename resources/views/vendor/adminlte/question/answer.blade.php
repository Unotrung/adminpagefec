@extends('layouts.app')

@section('title', 'Edit News')

@php
@endphp
@section('css')
<link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" 
     href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
@stop
@section('content_header')
<div class="container-fluid">
<div class="row mb-2">
<div class="col-sm-11">
            <h2 class="h3 mb-0 text-gray-800">Add Answer </h2>
</div>
<div class="col-sm-1">
            <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="{{ route('question.index') }}"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
        </div>
</div>
@stop
@section('content')
    <!-- DataTales Example -->
    <div class="col-md-12">
      <div class="card">
                <div class="card-body">
                  <form method="POST" action="{{route('question.updateAnswer', 'id='.$questions)}}" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="String" class="form-control" name="Email" placeholder="Email" value="{{$question->Email}}" readonly>
                        </div>
                      </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Question:</label>
                        <div class="col-md-10 fvalue" style="padding-top: 6px">{{$question->Question}} 
                        </div>
                    </div>
                    {{-- <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label" style="margin-right: 10px">Answer</label>
                        <textarea name="answer" id="summer_answer" cols="30" rows="10"></textarea>
                    </div> --}}
                    <div class="form-group row">
                      <label for="" class="col-sm-2 col-form-label">Answer</label>
                      <div class="col-sm-10">
                        <textarea name="answer" id="summer_answer" >
                        {!!$question->answer!!}
                        </textarea>
                      </div>
                    </div>
                  <div class="form-group row">
                    <div class="col-sm-6">
                      <div class="btn btn-info btn-user btn-block" style="width: 50%;margin-left: 50%;" onClick="checkSubmit(this.value)">
                        Send
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="btn btn-warning btn-user btn-block" style="width: 50%;" onClick="AnotherSubmit(this.value)">
                        Send & Add FAQ
                      </div>
                    </div>
                  </div>
                  <div class="modal" id="demoModal">
                    <div class="modal-dialog">
                      <div class="modal-content">
                      <!-- Modal Header -->
                        <div class="modal-header">
                          <h4 class="modal-title">Do you want to submit answer?  </h4>
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
                  <div class="modal" id="addModal">
                    <div class="modal-dialog">
                      <div class="modal-content">
                      <!-- Modal Header -->
                        <div class="modal-header">
                          <h4 class="modal-title">Do you want to submit answer & Add new FAQ?  </h4>
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
@endsection
@section('js')
<script src="../../plugins/summernote/summernote-bs4.min.js"></script>
<script>
    $(function () {
      $('#summer_question').summernote();
      $('#summer_answer').summernote('codeview.activate');
    });
    function checkSubmit(){
        var Answer = $('#summer_answer').val();
        if(Answer == ""){
			toastr["error"]("Please input Answer!")	
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
		if(Answer != "")
		{
			$("#demoModal").modal("show");
		}
		
	}
  function AnotherSubmit(){
        var Answer = $('#summer_answer').val();
        console.log(Answer);
        if(Answer == ""){
			toastr["error"]("Please input Answer!")	
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
		if(Answer != "")
		{
			$("#addModal").modal("show");
		}
		
	}
</script>
@stop
