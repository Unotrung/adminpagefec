@extends('layouts.app')

@section('title', 'Add FAQs')
@section('css')
<link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" 
     href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
@stop
@section('content_header')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Question</h1>
        <a href="{{route('question.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
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
            <form method="POST" action="{{route('question.store')}}">
                @csrf
                <!-- <div class="form-group row"> -->
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label" style="margin-right: 10px">Question</label>
                        <textarea name="Question_Create" id="summernote" cols="30" rows="10"></textarea>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                        <input type="string" class="form-control" name="Email" placeholder="Email" id="Email" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Phone Number</label>
                        <div class="col-sm-10">
                        <input type="string" class="form-control" name="PhoneNumber" placeholder="Phone Number" id="PhoneNumber" >
                        </div>
                    </div>
                {{-- Save Button --}}
                <div class="btn btn-success btn-user btn-block" style="width:20%; display:block; margin: 0 auto;" onClick="checkSubmit(this.value)">
                    Submit
                </div>
    
                <div class="modal" id="demoModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Do you want to add a new FAQ?  </h4>
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
@section('js')
<script src="../../plugins/summernote/summernote-bs4.min.js"></script>
<script>
    $(function () {
      $('#summernote').summernote();
    })
    $(function () {
      $('#summernote1').summernote();
    })

    function checkSubmit(){
        var Email = $('#Email').val();
		var PhoneNumber = $('#PhoneNumber').val();
        var question = $('#summernote').val();
        // console.log(Answer);
        console.log(question);
        // console.log(cate);
		if(question == ""){
			toastr["error"]("Please input question!")	
		}
        if(Email == ""){
			toastr["error"]("Please input Email!")	
		}
        if(PhoneNumber == ""){
			toastr["error"]("Please input Phone Number!")	
		}
		// if(IsEmail(Email)==false && Name.length === 0 && Email.length > 0 && phone.length === 0 ){
		// 	toastr["error"]("Your email is not correct , Please Input Phone Number & Name!")	
    	// }
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
		if(question != "" && PhoneNumber != "" && Email != "")
		{
			$("#demoModal").modal("show");
			formChanged = false;
		}
		
	}
</script>
@stop