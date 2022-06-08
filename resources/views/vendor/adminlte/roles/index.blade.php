@extends('layouts.app')

@section('title', 'Roles')
@section('css')
    <link rel="stylesheet" href="/css/app.css">
    <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" 
     href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <!-- Theme style -->
@stop

@section('content_header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-5">
      <h1 class="m-0">Roles</h1>
      
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item active">Roles</li>
      </ol>
    </div><!-- /.col -->
    <div class="col-sm-1">
      <a href="{{route('roles.add')}}" class="float-sm-right align-items-middle d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus"></i> Add</a>
      </div><!-- /.col -->
  </div><!-- /.container-fluid -->
</div><!-- /.row -->
@stop

@section('content')
    <!-- DataTales Example -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body" style="overflow-x: scroll;">
              <table class="table table-bordered table-striped" id="example1">
                <thead>
                  <tr>
                  <th>Display Name</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr></tr>
                </tbody>
              </table>
          </div>
        </div>
      </div>
    </div>
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
  @if(Session::has('ad'))
  toastr.options =
  {
    "closeButton" : true,
    "progressBar" : true
  }
      toastr.success("{{ session('ad') }}");
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

<!-- Page specific script -->
<script>
var editor;
$('[data-toggle="tooltip"]').tooltip();
  $(function () {
    $("#example1").DataTable({
      processing: true,
        serverSide: true,
        "ajax": "{{ route('roles.dtajax') }}",
        columns: [
          {data: 'display_name', name: 'display_name'},
          {data: 'name', name: 'name'},
          {data: 'description', name: 'description'},
          {
                  data: 'action', 
                  name: 'action', 
                  orderable: true, 
                  searchable: true
          },
        ],
        "columnDefs": [{
          "defaultContent": "-",
          "targets": "_all"
        }],
        drawCallback:function(setting){
          $('[data-toggle="tooltip"]').tooltip();
        }
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