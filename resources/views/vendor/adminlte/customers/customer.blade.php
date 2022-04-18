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
  <link href="toastr.css" rel="stylesheet"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" 
     href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  
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
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
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
								<input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="name" placeholder="Name" name="name" value=""> <span class="text-danger"></span>  </div> 
							<div class="col-sm-3 mb-2 mb-sm-0"> <span style="color:red;"></span>Email: </label>
								<input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="email" placeholder="Email" name="email" value="">  <span class="text-danger"></span> </div>
							<div class="col-sm-3 mb-3 mb-sm-0"> <span style="color:red;"></span>Phone: </label>
								<input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="phone" placeholder="Phone" name="phone" value="">  <span class="text-danger"></span> </div> 
              <!-- <div class="col-sm-2 mb-2 mb-sm-0 input-daterange"> <span style="color:red;">*</span>From Date </label>
                <input type="date" class="form-control form-control-user @error('name') is-invalid @enderror" id="from_date" placeholder="" name="from_date" value="">  <span class="text-danger"></span> </div> 
              <div class="col-sm-2 mb-2 mb-sm-0 input-daterange"> <span style="color:red;">*</span>To Date </label>
                <input type="date" class="form-control form-control-user @error('name') is-invalid @enderror" id="to_date" placeholder="" name="to_date" value="">  <span class="text-danger"></span> </div>  -->
                {{-- <div class="col-sm-4 mb-4 mb-sm-0"> <span style="color:red;"></span>Date Range: </label>
								<input type="text" class="form-control float-right" id="reservation" placeholder="" name="reservation" value="">  <span class="text-danger"><i class="far fa-calendar-alt"></i></span> </div>  --}}
                <div class="col-sm-1 mb-1 mb-sm-0 p-0">
                <div class="mt-4"></div>
                  <button type="button" name="filter" id="filter" class="btn btn-info w-100">Search</button>
						  </div>
              <div class="col-sm-1 mb-1 mb-sm-0 pl-1">
                <div class="mt-4"></div>
                  <button type="button" name="reset" id="reset" class="btn btn-danger w-100">Reset</button>
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
<script src="toastr.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js" integrity="sha512-k6/Bkb8Fxf/c1Tkyl39yJwcOZ1P4cRrJu77p83zJjN2Z55prbFHxPs9vN7q3l3+tSMGPDdoH51AEU8Vgo1cgAA==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css" integrity="sha512-3JRrEUwaCkFUBLK1phpN8HehwQgu8e23jTH4np5NHOmQOobuC4ROQxFwFgBLTnhcnQRMs84muMh0PnnwXlPq5MGjg==" crossorigin="anonymous" /> -->
<!-- Page specific script -->
<script>



$(document).ready(function(){
fill_datatable();
$('#reservation').daterangepicker().val('');
function fill_datatable(name = '',email=  '',action='',phone='',reservation = '')
{
    var keywork = (name=='')?((phone=='')?(email=='')?"":email:phone):name;
    var type = (name=='')?((phone=='')?(email=='')?"":"email":"phone"):"name";
    var from = reservation.endDate;
    var to = "";
    var jsonData = [
      { "meta": { "version": 1, "type": "test" } }
  ];
    var dataTable = $('#example1').DataTable({
        processing: true,
        serverSide: true,
        searching: false,
        ajax:{
            url: "{{ route('customer.dtajax') }}",
            data:{
            search:type,
            value:keywork,
            from: from,
            to: to,
          }
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
                  var d = new Date( data);
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
    var username = $('#name').val();
    var email = $('#email').val();
    var phone = $('#phone').val();
    var reservation = $('#reservation').val();
    // var to_date = $('#to_date').val();
    if(false)
    {
      toastr["error"]("Please select username!")
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
    }
    else
    {
      $('#example1').DataTable().destroy();
      fill_datatable(username,email,action="search",phone,reservation);
    }
});

$('#reset').click(function(){ 
    $('#name').val('');
    $('#email').val('');
    $('#phone').val('');
    $('#reservation').val('');
    // $('#to_date').val('');
    $('#example1').DataTable().destroy();
    fill_datatable();
});

}); 
function delete1(data){
  var id = data.attr("data-id");
  if (confirm('Are you sure you want to delete this?')) {
    var reservation = $('#reservation').val();
    $.ajax({
      url:"https://admin-voolo.herokuapp.com/v1/admin/deleteEAP/"+id,
      type:"delete",
      success:function(){
        $('#name').val('');
        $('#email').val('');
        $('#phone').val('');
        $('#reservation').val('');
        // $('#to_date').val('');
        $('#example1').DataTable().destroy();
      }
    });
  }
}
</script>
@stop