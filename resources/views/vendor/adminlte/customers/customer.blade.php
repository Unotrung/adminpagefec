@extends('layouts.app')
@section('title', 'Customers')
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
  <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
@stop
@php
  $customers = App\Models\Customer::all();
@endphp
@section('content_header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-5">
            <h1 class="m-0">Customers</h1>
            <small class="text-muted"><cite title="Source Title">Customers listing</cite></small>
          </div><!-- /.col -->
          <div class="col-sm-7">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Customers</li>
            </ol>
          </div><!-- /.col -->
          <!-- <div class="col-sm-2">
          <a href="{{route('customer.add')}}" class="float-sm-right align-items-middle d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-plus"></i> Add Customer</a>
          </div>/.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
@stop

@section('content')

    <!-- Main content -->
    <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
            <div class="d-sm-flex align-items-center justify-content-between mb-4" id="butlist">
              <h1 class="h3 mb-0 text-gray-800"></h1> 
            </div>
            
              <!-- /.card-header -->
          <div class="card-body" style="overflow-x: scroll;">
            <div class="form-group row">
							<div class="col-sm-3 mb-3 mb-sm-0"> <span style="color:red;"></span>Name: </label>
								<input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="username" placeholder="" name="username" value=""> <span class="text-danger"></span>  </div> 
							<div class="col-sm-2 mb-2 mb-sm-0"> <span style="color:red;"></span>Email: </label>
								<input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="email" placeholder="" name="email" value="">  <span class="text-danger"></span> </div> 
							<div class="col-sm-2 mb-2 mb-sm-0"> <span style="color:red;"></span>Phone: </label>
								<input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="phone" placeholder="" name="phone" value="">  <span class="text-danger"></span> </div> 
              <!-- <div class="col-sm-2 mb-2 mb-sm-0 input-daterange"> <span style="color:red;">*</span>From Date </label>
                <input type="date" class="form-control form-control-user @error('name') is-invalid @enderror" id="from_date" placeholder="" name="from_date" value="">  <span class="text-danger"></span> </div> 
              <div class="col-sm-2 mb-2 mb-sm-0 input-daterange"> <span style="color:red;">*</span>To Date </label>
               <input type="date" class="form-control form-control-user @error('name') is-invalid @enderror" id="to_date" placeholder="" name="to_date" value="">  <span class="text-danger"></span> </div>  -->
               <div class="col-sm-3 mb-3 mb-sm-0"> <span style="color:red;"></span>Date Range: </label>
								<input type="text" class="form-control float-right" id="reservation" placeholder="" name="reservation" value="">  <span class="text-danger"><i class="far fa-calendar-alt"></i></span> </div> 
                <!-- <div class="form-group">
                    <label>Date range:</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="far fa-calendar-alt"></i>
                        </span>
                      </div>
                      <input type="text" class="form-control float-right" id="reservation">
                    </div>

                </div>
               </div> -->
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
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Registered Date</th>
                    <!-- <th>Phone</th>
                    <th>Status</th>
                    <th>Created Time</th> -->
                    <th>Action</th>
                  </tr>
                  <tbody></tbody>
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
<!-- AdminLTE App -->
<script src="../../plugins/moment/moment.min.js"></script>
<script src="../../dist/js/adminlte.min.js"></script>
<script src="../../plugins/daterangepicker/daterangepicker.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js" integrity="sha512-k6/Bkb8Fxf/c1Tkyl39yJwcOZ1P4cRrJu77p83zJjN2Z55prbFHxPs9vN7q3l3+tSMGPDdoH51AEU8Vgo1cgAA==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css" integrity="sha512-3JRrEUwaCkFUBLK1phpN8HehwQgu8e23jTH4np5NHOmQOobuC4ROQxFwFgBLTnhcnQRMs84muMh0PnnwXlPq5MGjg==" crossorigin="anonymous" /> -->
<!-- Page specific script -->
<script>



$(document).ready(function(){

  $('#reservation').daterangepicker().val('');

fill_datatable();

function fill_datatable(username = '',email=  '',action='',phone='',reservation = '')
{
    var dataTable = $('#example1').DataTable({
        processing: true,
        serverSide: true,
        searching: false,
        ajax:{
            url: "{{ route('customer.dtajax') }}",
            data:{username:username , email:email , action:action , phone:phone ,reservation:reservation}
        },
        columns: [
            {
                data:'username',
                name:'Name'
            },
            {
                data:'email',
                name:'Email'
            },
            {
                data:'phone',
                name:'Phone'
            },
            {
                data:'createdAt',
                name:'Date Regis',
                render: function ( data, type, row ) {
              console.log(data);
              if ( type === 'display' || type === 'filter' ) {
                  var d = new Date( data.milliseconds*1);
                  return d.getDate() +'/'+ (d.getMonth()+1) +'/'+ d.getFullYear();
              }
              return data;}
            },
            {
                data: 'action', 
                name: 'action', 
                orderable: true, 
                searchable: true,
            },
        ]
    });
}




$('#filter').click(function(){
    var username = $('#username').val();
    var email = $('#email').val();
    var phone = $('#phone').val();
    var reservation = $('#reservation').val();
    // var to_date = $('#to_date').val();
    $('#example1').DataTable().destroy();
    fill_datatable(username,email,action="search",phone,reservation);
});

$('#reset').click(function(){
    $('#username').val('');
    $('#email').val('');
    $('#phone').val('');
    $('#reservation').val('');
    // $('#to_date').val('');
    $('#example1').DataTable().destroy();
    fill_datatable();
});

});




// Back Up version 1.0
  // $(function () {
  //   var table = $("#example1").DataTable({
  //       responsive: true, 
  //       lengthChange: true, 
  //       autoWidth: false,
  //       processing: true,
  //       serverSide: true,
  //       ajax: "{{ route('customer.dtajax') }}",
  //       columns: [
  //           {data: 'username', name: 'username'},
  //           {data: 'email', name: 'email'},
  //           {data: 'phone', name: 'phone'},
  //           {
  //               data: 'action', 
  //               name: 'action', 
  //               orderable: true, 
  //               searchable: true,
  //           },
  //       ],
  //   });
  //   table.buttons().container().appendTo('#butlist .col-md-6:eq(0)');
  // });    
  
  

</script>
@stop