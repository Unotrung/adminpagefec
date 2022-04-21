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
          <div class="col-3">
            <div class="card" style="text-align: left;padding:12px 20px">
              <h3>Filter By </h3>
              <div class="form-check">
                <input class="form-check-input" id="check_name" type="checkbox">
                <label class="form-check-label">Search by Name</label>
                <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="name" placeholder="Name" name="name" value="">  <span class="text-danger"></span>
              </div>
              <div class="form-check">
                <input class="form-check-input" id="check_phone" type="checkbox">
                <label class="form-check-label">Search by Phone</label>
                <input type="text" class="form-control form-control-user @error('phone') is-invalid @enderror" id="phone" placeholder="Phone" name="phone" value="">  <span class="text-danger"></span>
              </div>  
              <div class="form-check">
                <input class="form-check-input" id="check_email" type="checkbox">
                <label class="form-check-label">Search by Email</label>
                <input type="text" class="form-control form-control-user @error('email') is-invalid @enderror" id="email" placeholder="Email" name="email" value="">  <span class="text-danger"></span>
              </div>  
              <div class="form-check">
                <input class="form-check-input" id="check_nid" type="checkbox">
                <label class="form-check-label">Search by NID</label>
                <input type="text" class="form-control form-control-user @error('email') is-invalid @enderror" id="nid" placeholder="" name="nid" value="">  <span class="text-danger"></span>
              </div>
              <div class="form-check">
                <input class="form-check-input" id="check_address" type="checkbox">
                <label class="form-check-label">Search by Address</label>
                <input type="text" class="form-control form-control-user @error('email') is-invalid @enderror" id="address" placeholder="" name="address" value="">  <span class="text-danger"></span>
              </div>
              <div class="form-group row" style="text-align: left;padding:12px 20px">
              <div class="col-sm-6 mb-6 mb-1 mb-sm-0 pl-1">
                  <button type="button" name="filter" id="filter" class="btn btn-info w-100">Search</button>
              </div>
              <div class="col-sm-6 mb-6 mb-1 mb-sm-0 pl-1">
                <button type="button" name="reset" id="reset" class="btn btn-light w-100">Reset</button>
              </div>
              </div>
            </div>
          </div>
          <div class="col-9">
            <div class="card">
            <div class="d-sm-flex align-items-center justify-content-between mb-4" id="butlist">
              <h1 class="h3 mb-0 text-gray-800"></h1> 
            </div>
            
              <!-- /.card-header -->
          <div class="card-body" style="overflow-x: scroll;">
            {{-- <div class="form-group row">
							<div class="col-sm-3 mb-3 mb-sm-0"> <span style="color:red;"></span>Name: </label>
								<input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="name" placeholder="Name" name="name" value=""> <span class="text-danger"></span>  </div> 
							<div class="col-sm-3 mb-2 mb-sm-0"> <span style="color:red;"></span>Email: </label>
								<input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="email" placeholder="Email" name="email" value="">  <span class="text-danger"></span> </div>
							<div class="col-sm-3 mb-3 mb-sm-0"> <span style="color:red;"></span>Phone: </label>
								<input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="phone" placeholder="Phone" name="phone" value="">  <span class="text-danger"></span> </div> 
             <div class="col-sm-1 mb-1 mb-sm-0 p-0">
                <div class="mt-4"></div>
                  <button type="button" name="filter" id="filter" class="btn btn-info w-100">Search</button>
						  </div>
              <div class="col-sm-1 mb-1 mb-sm-0 pl-1">
                <div class="mt-4"></div>
                  <button type="button" name="reset" id="reset" class="btn btn-danger w-100">Reset</button>
              </div>
            </div> --}}
                <table id="example1" class="table table-bordered table-striped">

                  <thead>
                  <tr>
                    <th>EAP UserName</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>BNPL CitizenId</th>
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
fill_datatable('a');
  $('#reservation').daterangepicker().val('');
  function fill_datatable(username = '',email=  '',action='',phone='',reservation = '',citizenId='')
  {
      var search = {};
      search.username = ($("#check_name").is(":checked"))?username:"";
      search.email = ($("#check_email").is(":checked"))?email:"";
      search.phone = ($("#check_phone").is(":checked"))?phone:"";
      search.citizenId = ($("#check_nid").is(":checked"))?citizenId:"";
      // search["nid"] = ($("#check_nid").is(":checked"))?nid:"";

      var dataTable = $('#example1').DataTable({
          processing: true,
          serverSide: true,
          searching: false,
          ajax:{
              url: "{{ route('customer.dtajax') }}",
              data:{
                filter : search
              }
          },
          columns: [
              {
                  data:'username',
                  name:'EAP Username',
                  render: function ( data, type, row ) {
                    console.log(data);
                    return (data!==undefined)?data:".";
                  }
              },
              {
                  data:'email',
                  name:'Email',
                  render: function ( data, type, row ) {
                    
                    return (data!==undefined)?data:".";
                  }
              },
              {
                  data:'phone',
                  name:'Phone',
                  render: function ( data, type, row ) {
                    console.log(data);
                    return (data!==undefined)?data:".";
                  }
              },
              {
                  data:'bnpl',
                  name:'BNPL CitizenId',
                  render: function ( data, type, row ) {
                    console.log(data);
                    var str="";
                    data.forEach(element => {
                      str += element.citizenId+"<br/>";
                    });
                    return str;
                  }
              },
              {
                  data: 'action', 
                  name: 'action', 
                  orderable: true, 
                  searchable: true,
              },
          ],
          columnDefs: [
              { targets: '_all', visible: true }
          ]
      });
  }
  $('#filter').click(function(){
      var username = $('#name').val();
      var email = $('#email').val();
      var phone = $('#phone').val();
      var citizenId = $('#nid').val();
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
        fill_datatable(username,email,action="search",phone,reservation,citizenId);
      }
  });

  $('#reset').click(function(){ 
      $('#name').val('');
      $('#email').val('');
      $('#phone').val('');
      $('#reservation').val('');
      if($('#check_name').prop('checked',true))
      {
        $('#check_name').click();
        $('#name').hide();
        
      }
      if($('#check_phone').prop('checked',true))
      {
        $('#check_phone').click();
        $('#phone').hide();
      }
      if($('#check_email').prop('checked',true))
      {
        $('#check_email').click();
        $('#email').hide();
      }
      if($('#check_address').prop('checked',true))
      {
        $('#check_address').click();
        $('#address').hide();
      }
      if($('#check_nid').prop('checked',true))
      {
        $('#check_nid').click();
        $('#nid').hide();
      }
      // $('#check_email').click();
      // $('#check_address').click();
      // $('#check_nid').click();
      // $('#to_date').val('');
      $('#example1').DataTable().destroy();
      fill_datatable();
  });

  $('#name').hide();
  $('#phone').hide();
  $('#email').hide();
  $('#nid').hide();
  $('#address').hide();
  // check for name field
  $('#check_name').change(function()
  {
  //   if($('#check_name').prop('checked',true))
  //     {
        $("#name").toggle();
        $("#name").val("");
      // }
  });
  // check for nid field
  $('#check_nid').change(function()
  {
    $("#nid").toggle();
    $("#nid").val("");
  });
// check for address field
  $('#check_address').change(function()
  {
    $("#address").toggle();
    $("#address").val("");
  });
// check for phone field
  $('#check_phone').change(function()
  {
    $("#phone").toggle();
    $("#phone").val("");
  });
// check for email field
  $('#check_email').change(function()
  {
    $("#email").toggle();
    $("#email").val("");
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