@extends('layouts.app')

@section('title', 'Configuration')
@section('content_header')

@stop
{{-- @section('content')   
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Send OTP To Mobile</label>
                <div class="col-md-10 fvalue"><input type="checkbox" name="View" value="Customers" onclick="handleClick(this.value,this.name);"></div>
                </div>
              </div>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Send OTP To Email</label>
                <div class="col-md-10 fvalue"><input type="checkbox" name="View" value="Customers" onclick="handleClick(this.value,this.name);"></div>
                </div>
              </div>
        </div>
    </div>

</div>


@endsection --}}

@section('content')  



<section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <ul class="nav nav-tabs" id="custom-content-above-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="custom-content-above-home-tab" data-toggle="pill" href="#custom-content-above-home" role="tab" aria-controls="custom-content-above-home" aria-selected="true">Setting Send OTP</a>
              </li>
            </ul>
            <!-- <div class="tab-custom-content">
              <p class="lead mb-0">"Information BNPL"</p>
            </div> -->
            <div class="tab-content" id="custom-content-above-tabContent">
              <div class="tab-pane fade show active" id="custom-content-above-home" role="tabpanel" aria-labelledby="custom-content-above-home-tab">
                  <!-- Horizontal Form -->
            <div class="card card-info">
              <!-- <div class="card-header">
                <h3 class="card-title">Edit user</h3>
              </div> -->
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body">
                  <div class="form-group">
                    {{-- <div class="col-sm-3 mb-3 mb-sm-0"> <span style="color:red;"></span>Name: </label> --}}
                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success ">
                      {{-- <div class="col-sm-3 mb-3 mb-sm-0">  --}}
                    <input type="checkbox" class="custom-control-input" id="customSwitch3"><label class="custom-control-label" for="customSwitch3">Sent OTP To Mobile Phone</label>
                    {{-- </div> --}}
                  <div class="form-group row">
                    <div class="col-sm-10">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Sent OTP To Mobile Phone</label>
                      <input type="checkbox" name="View" value="" onclick="handleClick(this.value,this.name);">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-10">
                      <label for="inputPassword3" class="col-sm-4 col-form-label">Sent OTP To Email Address</label>
                      <input type="checkbox" name="View" value="" onclick="handleClick(this.value,this.name);">
                    </div>
                  </div>
                  <div class="form-group">
                    {{-- <div class="col-sm-3 mb-3 mb-sm-0"> <span style="color:red;"></span>Name: </label> --}}
                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success ">
                      {{-- <div class="col-sm-3 mb-3 mb-sm-0">  --}}
                    <input type="checkbox" class="custom-control-input" id="customSwitch4"><label class="custom-control-label" for="customSwitch4">Sent OTP To Email Address</label>
                    {{-- </div> --}}
                  </div>
                  </div>
                  </div>
                </div>
                <!-- /.card-body -->
                    
                <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
                </div>
                <!-- /.card-footer -->
            </div>
            <!-- /.card -->
              </div>
            
      <!-- /.timeline -->

    </section>
</div>
<!-- /.card -->
  </div>
@endsection





@section('js')
<!-- DataTables  & Plugins -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- Page specific script -->
<script>


    

</script>

@stop