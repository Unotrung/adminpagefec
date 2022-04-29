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
              <div class="card-body">
              <div class="row" style="margin-bottom: 20px;">
                <div class="col-3">
                  <label class="form-check-label" style="" for="">Search by Name</label>
                  <div class="input-group input-group-sm">
                    <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="name" placeholder="Name" name="name" value="" style="">  <span class="text-danger"></span>
                  </div>
                </div>
                <div class="col-3">
                  <label class="form-check-label" style="">Search by Phone</label>
                  <div class="input-group input-group-sm">
                    <input type="text" class="form-control form-control-user @error('phone') is-invalid @enderror" id="phone" placeholder="Phone" name="phone" value="" style="">  <span class="text-danger"></span>
                  </div>
                </div>
                <div class="col-3">
                  <label class="form-check-label" style="" >Search by Email</label>
                  <div class="input-group input-group-sm">
                    <input type="text" class="form-control form-control-user @error('email') is-invalid @enderror" id="email" placeholder="Email" name="email" value="" style="">  <span class="text-danger"></span>
                  </div>
                </div>
                <div class="col-sm-1,5">
                  <label>    </label>
                    <button type="button" name="filter" id="filter" class="btn btn-info w-100">Search</button>
                
                </div>
                <div class="col-sm-1,5">
                  <label>    </label>
                    <button type="button" name="reset" id="reset" class="btn btn-light w-100">Reset</button>
                  
                </div>
              </div>
              <div id="clicks">
                <a href="#searchadvance" class="click" id="showInfo" data-target="searchadvance"><button><i class="fa fa-search"></i>Search Advance</button></a>
              </div>
              <div class="searchadvance target" style="display: none;"><a name="searchadvance">
                <div class="row" style="margin-bottom: 20px;"> 
                <div class="col-2">
                  <label class="form-check-label" >Search by NID</label>
                  <div class="input-group input-group-sm">
                    <input type="text" class="form-control form-control-user @error('email') is-invalid @enderror" id="nid" placeholder="" name="nid" value="" style="">  <span class="text-danger"></span>
                  </div>
                </div>
                <div class="col-2">
                  <label class="form-check-label">Date:</label>
                  <div class="input-group input-group-sm" id="reservationdate" data-target-input="nearest">
                  {{-- <div class="input-group date" > --}}
                    <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" />
                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  {{-- </div> --}}
                  </div>
                </div>
                <div class="col-2">
                  <label class="form-check-label">Thành phố/Tỉnh:</label>
                  <div class="input-group input-group-sm">
                  <select id="city" class="form-control" name="city">
                    <option value="" selected="">TP.Hồ Chí Minh</option>																			
                    <option value="623d5e16d2b54784ff29a332">TP.Hà Nội</option>
                    <option value="623d5e2cc682d3f0ff4ced22">TP.Cần Thơ</option>
                    {{-- <option value="623d5e2cc682d3f0ff4ced22">Center</option> --}}
                  </select>
                  </div>
                </div> 
                <div class="col-2">
                  <label class="form-check-label">Quận/Huyện</label>
                  <div class="input-group input-group-sm">
                  <select id="Distric" class="form-control" name="Distric">
                    <option value="" selected="">Quận 1</option>																			
                    <option value="623d5e16d2b54784ff29a332">TP.Hà Nội</option>
                    <option value="623d5e2cc682d3f0ff4ced22">TP.Cần Thơ</option>
                    {{-- <option value="623d5e2cc682d3f0ff4ced22">Center</option> --}}
                  </select>
                  </div>
                </div>
                <div class="col-2">
                  <label class="form-check-label">Phường/Xã</label>
                  <div class="input-group input-group-sm">
                  <select id="ward" class="form-control" name="ward">
                    <option value="" selected="">Bến Nghé</option>																			
                    <option value="623d5e16d2b54784ff29a332">TP.Hà Nội</option>
                    <option value="623d5e2cc682d3f0ff4ced22">TP.Cần Thơ</option>
                    {{-- <option value="623d5e2cc682d3f0ff4ced22">Center</option> --}}
                  </select>
                  </div>
                </div>
                <div class="col-sm-1,5">
                  <label>    </label>
                    <button type="button" name="filter" id="filter1" class="btn btn-info w-100">Search</button>
                
                </div>
                <div class="col-sm-1,5">
                  <label>    </label>
                    <button type="button" name="reset1" id="reset1" class="btn btn-light w-100">Reset</button>
                  
                </div>
              </div>
              </a> 
              </div>
              </div>
            </div>
            
            <div class="card">
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
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
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
      search.username = ($('#name').val()!=null)?username:"";
      search.email = ($('#email').val()!=null)?email:"";
      search.phone = ($('#phone').val()!=null)?phone:"";
      search.citizenId = ($('#nid').val()!=null)?citizenId:"";
      console.log("aaaaaaaaaaaa" + citizenId)
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
      var username = $('#name').val();
      var email = $('#email').val();
      var phone = $('#phone').val();
      var citizenId = $('#nid').val();
      // var reservation = $('#reservation').val();
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
        fill_datatable(username,email,action="search",phone,citizenId);
      }
  });


  // $('#filter1').click(function(){
  //     var username = $('#name').val();
  //     var email = $('#email').val();
  //     var phone = $('#phone').val();
  //     var citizenId = $('#nid').val();
  //     // console.log(citizenId);
  //     // var reservation = $('#reservation').val();
  //     // var to_date = $('#to_date').val();
  //     if(false)
  //     {
  //       toastr["error"]("Please select username!")
  //       toastr.options = {
  //         "closeButton": false,
  //         "debug": true,
  //         "newestOnTop": false,
  //         "progressBar": false,
  //         "positionClass": "toast-top-right",
  //         "preventDuplicates": false,
  //         "onclick": null,
  //         "showDuration": "300",
  //         "hideDuration": "1000",
  //         "timeOut": "5000",
  //         "extendedTimeOut": "1000",
  //         "showEasing": "swing",
  //         "hideEasing": "linear",
  //         "showMethod": "fadeIn",
  //         "hideMethod": "fadeOut"
  //       }
  //     }
  //     else
  //     {
  //       $('#example1').DataTable().destroy();
  //       fill_datatable(username,email,action="search",phone,citizenId);
  //     }
  // });

  $('#reset').click(function(){ 
      $('#name').val('');
      $('#email').val('');
      $('#phone').val('');
      // $('#reservation').val('');
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
      $('#filter').hide();
      $('#reset').hide();
      $('#example1').DataTable().destroy();
      fill_datatable();
  });
  // $('#filter').hide();
  // $('#reset').hide();
  // $('#name').hide();
  // $('#phone').hide();
  // $('#email').hide();
  // $('#nid').hide();
  // $('#address').hide();
  
});
$(function () { 
  $('#reservationdate').datetimepicker({
          format: 'L'
      });
})
function doToggle(num) {
          var target = $('div.target' + num);
          $(target).toggle();
          $('.target').not(target).hide();
          console.log("toggling");
          console.log($('div.target:visible'));
          $('#text').css('display', $('div.target:visible').length ? 'none' : 'block')
      }

      $('#clicks .click').click(function () {
          console.log("clicked");
          var num = '.' + $(this).data('target');
          console.log(num);
          if (num === '.' + location.hash.substring(1)) {
              doToggle(num);
          }
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