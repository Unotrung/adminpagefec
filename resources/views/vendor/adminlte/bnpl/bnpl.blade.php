@extends('layouts.app')
@section('title', 'Dashboard')
@section('css')


  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">

@stop
@section('content_header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">BNPL Registrations</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">BNPL</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
@stop

@section('content')


    <!-- Main content -->
    <section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="overflow-x: scroll;">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Customer name</th>
                    <th>Phone</th>
                    <!-- <th>Image</th>
                    <th>NID</th>
                    <th>NID Image</th>
                    <th>Gender</th>
                    <th>Pin Code</th>
                    <th>DOB</th>
                    <th>DON</th> -->
                    <th>Date Regis</th>
                    <!-- <th>Address</th>
                    <th>Code</th>
                    <th>Code Name</th>
                    <th>Division Type</th>
                    <th>District</th>
                    <th>Type Relation</th>
                    <th>Phone Relation</th>
                    <th>Name Relation</th>
                    <th>Contract</th> -->
                    <th>Stage</th>
                    <th>Status</th>
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
<!-- AdminLTE for demo purposes -->

<!-- Page specific script -->
<script>
var editor;
  $(function () {
    $("#example1").DataTable({
      processing: true,
        serverSide: true,
        "ajax": "{{ route('bnpl.dtajax') }}",
        columns: [
          {data: 'name', name: 'name'},
          {data: 'phone', name: 'phone'},
          {data: 'createdAt', name: 'issueDate',
            render: function ( data, type, row ) {
              console.log(data);
              if ( type === 'display' || type === 'filter' ) {
                  var d = new Date( data.milliseconds*1);
                  return d.getDate() +'-'+ (d.getMonth()+1) +'-'+ d.getFullYear();
              }
              return data;}
          
          },
          
          {data:'sex',
            "searchable": false,
            "orderable":false,
            "render": function (data, type, row) {
              if (row.name === null) {
                return "<i>Nhập  Thông Tin<i>";
            }
            else if(row.phone === null)
            {
              return "<i>Cài đặt Pin Code<i>";
            }
            else
            {
              return "<i>Xác thực người dùng<i>";
            }
            return data;}
          },
          {
            "defaultContent": "<i>Waiting</i>"
          },
          {
                  data: 'action', 
                  name: 'action', 
                  orderable: true, 
                  searchable: true
          },
        ],
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