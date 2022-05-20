@extends('layouts.app')

@section('title', 'Add Module')
@section('css')
<link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.min.css">
{{-- Toast Notification --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" 
   href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

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
                        <input type="string" class="form-control" name="module" id="module" placeholder="Module Name" >
                        </div>
                    </div>
                <!-- </div> -->
                {{-- Save Button --}}
                <button type="submit" id="submit" class="btn btn-success btn-user btn-block" style="width:20%; display:block; margin: 0 auto;">
                    Save
                </button>

            </form>
        </div>
    </div>

</div>


@endsection
@section('js')
<script src="../../plugins/summernote/summernote-bs4.min.js"></script>
<?php
  $customers = App\Models\Modules::all();
?>
<script>
    <?php
       echo "var jsvar ='$customers';";
    ?>
    $(function () {
        
      $('#summernote').summernote();

      $('#submit').click(function(){
      var modules = $('#module').val();
      console.log(modules);
      if( jsvar.includes(modules) == true)
      {
        toastr["error"]("Module Name already exists")
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
        return false;
      }
      if( modules == '')
      {
        toastr["error"]("Please Input Module Name")
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
        return false;
      }
    //   else
    //   {
    //     $('#classDatatable').show();
    //     $('#example1').DataTable().destroy();
    //     fill_datatable(username,email,action="search",phone,citizenId);
    //   }
      });
    })

    
</script>
@stop
