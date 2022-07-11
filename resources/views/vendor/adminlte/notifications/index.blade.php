@extends('layouts.app')

@section('title', 'Notifications')
@section('css')


  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">

@stop
@section('content_header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-5">
      <h1 class="m-0">Notifications</h1>
      <small class="text-muted"><cite title="Source Title">Notifications Listing</cite></small>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Notifications</li>
            </ol>
    </div><!-- /.col -->
    <div class="col-sm-1">
      <a href="{{route('notifications.add')}}" class="float-sm-right align-items-middle d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-plus"></i> Add</a>
      </div><!-- /.col -->
  </div><!-- /.container-fluid -->
</div>
@stop
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body" style="overflow-x: scroll;">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Title</th>
                    <th>Date Post</th>
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

<!-- Page specific script -->
<script>
var editor;
  $(function () {

    $("#example1").DataTable({
      processing: true,
        serverSide: true,
        "ajax": "{{ route('notifications.dtajax') }}",
        columns: [
          {data: 'Title', name: 'Title'},
          {data: 'created_at', name: 'Date Post'  },
          {
                  data: 'action',
                  name: 'action',
                  orderable: true,
                  searchable: true
          },

        ],
        columnDefs: [ {
        targets: 1,
        render: $.fn.dataTable.render.moment('YYYY-MM-DDTHH:mm:ss.SSSSZ','DD/MM/YYYY' )
        } ]
        // columnDefs: [ {
        //     targets: 2,
        //     render: $.fn.dataTable.render.moment( 'Do MMM YYYY' )
        //     } ]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6');
  });
</script>

@stop
