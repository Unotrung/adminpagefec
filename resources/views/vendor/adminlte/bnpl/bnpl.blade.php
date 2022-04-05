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
            <h1 class="m-0">BNPL Registration</h1>
            <small class="text-muted"><cite title="Source Title">BNPL listing</cite></small>
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
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="info-box bg-info">
              <div class="inner">
                <h3>{{count($bnpl)}}</h3>
                <p>Total BNPL Registers</p>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="info-box bg-success">
              <div class="inner">
                <h3>
                {{count($name)}}
                  <sup style="font-size: 20px"></sup></h3>
                <p>Stage: Nhập Thông Tin</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="info-box bg-warning">
              <div class="inner">
                <h3> {{count($phone)}}</h3>
                <p>Stage: Cài đặt Pin Code</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="info-box bg-danger">
              <div class="inner">
                <h3>{{count($identify)}}</h3>
                <p>Stage: Xác thực người dùng</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body" style="overflow-x: scroll;">
            <div class="form-group row">
							<div class="col-sm-2 mb-2 mb-sm-0"> <span style="color:red;">*</span>Name: </label>
								<input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="name" placeholder="Name" name="name" value=""> <span class="text-danger"></span>  </div> 
							<!-- <div class="col-sm-2 mb-2 mb-sm-0"> <span style="color:red;">*</span>Status: </label>
								<input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="email" placeholder="Status" name="status" value="">  <span class="text-danger"></span> </div>  -->
							<div class="col-sm-2 mb-2 mb-sm-0"> <span style="color:red;">*</span>Phone: </label>
								<input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="phone" placeholder="Phone number" name="phone" value="">  <span class="text-danger"></span> </div> 
              <div class="col-sm-2 mb-2 mb-sm-0 input-daterange"> <span style="color:red;">*</span>From Date </label>
                <input type="date" class="form-control form-control-user @error('name') is-invalid @enderror" id="from_date" placeholder="" name="from_date" value="">  <span class="text-danger"></span> </div> 
              <div class="col-sm-2 mb-2 mb-sm-0 input-daterange"> <span style="color:red;">*</span>To Date </label>
                <input type="date" class="form-control form-control-user @error('name') is-invalid @enderror" id="to_date" placeholder="" name="to_date" value="">  <span class="text-danger"></span> </div> 
              <div class="col-sm-1 mb-1 mb-sm-0 p-0">
                <div class="mt-4"></div>
                  <button type="button" name="filter" id="filter" class="btn btn-info w-100">Search</button>
						  </div>
              <div class="col-sm-1 mb-1 mb-sm-0 pl-1">
                <div class="mt-4"></div>
                  <button type="button" name="reset" id="reset" class="btn btn-default w-100">Reset</button>
              </div>
            </div>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Name</th>
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
        searching: false,
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
    });

    $('#filter').click(function(){
    var name = $('#name').val();
    //var status = $('#status').val();
    var phone = $('#phone').val();
    var from_date = $('#from_date').val();
    var to_date = $('#to_date').val();
    $('#example1').DataTable().destroy();
    fill_datatable(name,action="search",phone,from_date, to_date);
});

$('#reset').click(function(){
    $('#name').val('');
    //$('#status').val('');
    $('#phone').val('');
    $('#from_date').val('');
    $('#to_date').val('');
    $('#example1').DataTable().destroy();
    fill_datatable();
});
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