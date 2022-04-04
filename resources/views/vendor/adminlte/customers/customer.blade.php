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
							<div class="col-sm-2 mb-2 mb-sm-0"> <span style="color:red;">*</span>Name: </label>
								<input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="username" placeholder="Name" name="username" value=""> <span class="text-danger"></span>  </div> 
							<div class="col-sm-2 mb-2 mb-sm-0"> <span style="color:red;">*</span>Email: </label>
								<input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="email" placeholder="Email" name="email" value="">  <span class="text-danger"></span> </div> 
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
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Date Regis</th>
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
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->

<!-- Page specific script -->
<script>



$(document).ready(function(){

fill_datatable();

function fill_datatable(username = '',email=  '',action='',phone='',from_date = '', to_date = '')
{
    var dataTable = $('#example1').DataTable({
        processing: true,
        serverSide: true,
        searching: false,
        ajax:{
            url: "{{ route('customer.dtajax') }}",
            data:{username:username , email:email , action:action , phone:phone ,from_date:from_date, to_date:to_date}
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
    var from_date = $('#from_date').val();
    var to_date = $('#to_date').val();
    $('#example1').DataTable().destroy();
    fill_datatable(username,email,action="search",phone,from_date, to_date);
});

$('#reset').click(function(){
    $('#username').val('');
    $('#email').val('');
    $('#phone').val('');
    $('#from_date').val('');
    $('#to_date').val('');
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