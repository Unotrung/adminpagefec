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
              <div class="card-body">
                <div class="row" style="margin-bottom: 20px">
                  <div class="col-4">

                    <div class="input-group input-group-md">
                      <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="name" placeholder="Name" name="name" value="" style="">  
                    </div>
                  </div>
                  <div class="col-4">

                    <div class="input-group input-group-md">
                      <input type="text" class="form-control form-control-user @error('phone') is-invalid @enderror" id="phone" placeholder="Phone" name="phone" value="" style="">  
                    </div>
                  </div>
                  <div class="col-4">

                    <div class="input-group input-group-md">
                      <input type="text" class="form-control form-control-user" id="email" placeholder="Email" name="email" value="" style="">  
                    </div>
                  </div>
                </div>
                <div class="searchadvance target" style="">
                  <div class="row" style="margin-bottom: 20px;"> 
                  <div class="col-4">
                    <div class="input-group input-group-md">
                      <input type="text" class="form-control form-control-user" id="nid" placeholder="Search by NID" name="nid" value="" style="">
                    </div>
                  </div>
                  <div class="col-8">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="far fa-calendar-alt"></i>
                        </span>
                      </div>
                      <input type="text" class="form-control float-right" id="reservation">
                    </div>
                  </div>
                </div>
                <div class="row align-items-center d-flex">
                  <div class="container">
                    <div class="col text-center">
                        <button type="button" name="filter" id="filter" class="btn btn-info" style="width:30%">Search</button>
                        <button type="button" name="reset" id="reset" class="btn btn-light" style="width:10%">Reset</button>
                    </div>
                    
                  </div>
                </div>
              </div>
              </div>
            </div>
            
            <div class="card" style="display:none" id="classDatatable">
              <div class="d-sm-flex align-items-center justify-content-between mb-4" id="butlist">
                <h1 class="h3 mb-0 text-gray-800"></h1> 
              </div>
            
              <!-- /.card-header -->
              <div class="card-body" style="overflow-x: scroll;">
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

<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>


<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<!-- AdminLTE App -->
<script src="../../plugins/moment/moment.min.js"></script>

<script src="../../plugins/daterangepicker/daterangepicker.js"></script>
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- AdminLTE for demo purposes -->
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js" integrity="sha512-k6/Bkb8Fxf/c1Tkyl39yJwcOZ1P4cRrJu77p83zJjN2Z55prbFHxPs9vN7q3l3+tSMGPDdoH51AEU8Vgo1cgAA==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css" integrity="sha512-3JRrEUwaCkFUBLK1phpN8HehwQgu8e23jTH4np5NHOmQOobuC4ROQxFwFgBLTnhcnQRMs84muMh0PnnwXlPq5MGjg==" crossorigin="anonymous" /> -->
<!-- Page specific script -->
<script>



$(document).ready(function(){
  $('#reservation').daterangepicker({
    ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
    startDate: moment().subtract(1, 'year'),
    endDate  : moment()
  });


  fill_datatable('a');

  function fill_datatable(username = '',email=  '',action='',phone='',reservation = '',citizenId='')
  {
      var search = {};
      search.username = ($('#name').val()!=null)?username:"";
      search.email = ($('#email').val()!=null)?email:"";
      search.phone = ($('#phone').val()!=null)?phone:"";
      search.citizenId = ($('#nid').val()!=null)?citizenId:"";
      search.from = $('#reservation').data('daterangepicker').startDate.format("YYYY-MM-DD");
      search.to = $('#reservation').data('daterangepicker').endDate.format("YYYY-MM-DD");
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
                  data:'urlphone',
                  name:'Phone',
                  render: function ( data, type, row ) {
                    return (data!==undefined)?data:".";
                  }
              },
              {
                  data:'bnpl',
                  name:'BNPL CitizenId',
                  render: function ( data, type, row ) {
                    if(data!==undefined)
                    {
                    var str="";
                    data.forEach(element => {
                      str += element.citizenId+"<br/>";
                    });
                    return str;
                    }
                    else
                    {
                      return ".";
                    }
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
    if($('#reservation').val() === ""){ 
      return false;
    }
    $('#classDatatable').show(); 
      var username = $('#name').val();
      var email = $('#email').val();
      var phone = $('#phone').val();
      var citizenId = $('#nid').val();
      $('#example1').DataTable().destroy();
      fill_datatable(username,email,action="search",phone,citizenId);
  });

  $('#reset').click(function(){ 
      $('#name').val('');
      $('#email').val('');
      $('#phone').val('');
      $('#reservation').daterangepicker({
        startDate: moment().subtract(1, 'year'),
        endDate  : moment()
      });
      if($('#check_name').prop('checked',true))
      {
        $('#check_name').click();
        
      }
      if($('#check_phone').prop('checked',true))
      {
        $('#check_phone').click();
      }
      if($('#check_email').prop('checked',true))
      {
        $('#check_email').click();
      }
      if($('#check_address').prop('checked',true))
      {
        $('#check_address').click();
      }
      if($('#check_nid').prop('checked',true))
      {
        $('#check_nid').click();
      }
      // $('#check_email').click();
      // $('#check_address').click();
      // $('#check_nid').click();
      // $('#to_date').val('');
      $('#example1').DataTable().destroy();
      // fill_datatable();
  });
  // $('#filter').hide();
  // $('#reset').hide();
  // $('#name').hide();
  // $('#phone').hide();
  // $('#email').hide();
  // $('#nid').hide();
  // $('#address').hide();
  
});
</script>
@stop