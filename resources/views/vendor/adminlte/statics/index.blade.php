@extends('layouts.app')

@section('title', 'Statics Page')
@section('css')

  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css"
     href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">


@stop

@section('content_header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-5">
      <h1 class="m-0">Statics Page</h1>
      <small class="text-muted"><cite title="Source Title">Statics Page Listing</cite></small>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item active">Statics Page</li>
      </ol>
    </div><!-- /.col -->
    <div class="col-sm-1">
      <a href="{{route('statics.add')}}" class="float-sm-right align-items-middle d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-plus"></i> Add</a>
      </div><!-- /.col -->
  </div><!-- /.container-fluid -->
</div><!-- /.row -->
@stop





@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="row" style="margin-bottom: 10px;">
                <div class="col-md-11">
                    <input type="search" class="form-control form-control-lg" id ="input" placeholder="Type your keywords here" value="">
                </div>
                <div class="col-1">
                {{-- <div class="input-group-append"> --}}
                        <button type="submit" class="btn btn-lg btn-default" id="search" style="height: 47px; width: 100%;">
                        <i class="fa fa-search"></i>
                        </button>
                {{-- </div> --}}
                </div>
            </div>

            <div class="row" style="margin-bottom: 15px;margin-top: 10px;">
                <div class="col-md-4">
                    <div class="input-group input-group-sm">
                        <select class="select2 custom-select custom-select-sm form-control form-control-sm" style="width: 100%;" id="type" name="type">
                          <option value="" >Choose type...  </option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                        </select>
                      </div>
                </div>

                <div class="col-md-4">
                    <div class="input-group input-group-sm">
                        <select class="select2 custom-select custom-select-sm form-control form-control-sm" style="width: 100%;" id="type" name="type">
                          <option value="" >Choose status...  </option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                        </select>
                      </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group input-group-sm">
                        <select class="select2 custom-select custom-select-sm form-control form-control-sm" style="width: 100%;" id="type" name="type">
                          <option value="" >Choose Language...  </option>
                          <option value="1">Vietnamese</option>
                          <option value="2">English</option>
                          <option value="3">Chinese</option>
                        </select>
                      </div>
                </div>
            </div>




            </div>
        </div>


            <div class="card">
              <!-- /.card-header -->
              <div class="card-body" style="overflow-x: scroll;">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Page Name</th>
                    <th>Status</th>
                    <th>Type</th>
                    <th>Language</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                  </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <script>
        @if(Session::has('success'))
        toastr.options =
        {
          "closeButton" : true,
          "progressBar" : true
        }
        toastr.success("{{ session('success') }}");
        @endif
        @if(Session::has('delete'))
        toastr.options =
        {
          "closeButton" : true,
          "progressBar" : true
        }
            toastr.success("{{ session('delete') }}");
        @endif
      </script>
      </section>
      <!-- /.content -->
  @stop
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
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
      <!-- <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.js"></script> -->

      <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.16/sorting/datetime-moment.js"></script>

      <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.21/dataRender/datetime.js"></script>

  <!-- AdminLTE for demo purposes -->
  <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet"> -->
  <!-- Page specific script -->

  <script>

  var editor;
    $(function () {

      $("#example1").DataTable({
        processing: true,
          serverSide: true,
          "ajax": "{{ route('statics.dtajax') }}",
          columns: [
            {data: 'Page Name', name: 'Pagename'},
            {data: 'Status', name: 'Status'},
            {data: 'Type', name: 'Type'},
            {data: 'Language', name: 'Language'},
            {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,

            },
          ],
          columnDefs: [
            ]

      }).buttons().container().appendTo('#example1_wrapper .col-md-6');
    });
  </script>

  <!-- <script>
    $(document).ready( function () {
      $('#example1').DataTable(
        {
          "buttons": [ "excel", "pdf"]
        }
      ).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)') ;
  } );
  </script>  -->

  @stop
