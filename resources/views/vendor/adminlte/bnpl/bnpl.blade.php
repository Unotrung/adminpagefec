

@extends('layouts.app')
@section('title', 'Dashboard')
@section('css')


  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
  {{-- Style forr toast  --}}

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
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
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
            <div class="small-box bg-info">
              <div class="inner">
                <h3 class="total">{{count($bnpl)}}</h3>
                <p>Total BNPL Registing</p>
              </div>
              <div class="icon">
              <i class="fas fa-user-plus"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3 class="step2">{{count($name)}}</h3>
                <p>Stage: Input information</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-check"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3 class="step3"> {{count($phone)}}</h3>
                <p>Stage: Setup pincode</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-lock"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3 class="step4">{{count($identify)}}</h3>
                <p>Stage: Verify registration</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-shield"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <div class="row">
          <div class="col-3">
            <div class="card" style="text-align: left;padding:12px 20px">
              <h6 style="font-weight: bold">Filter By </h6>
              <div class="form-check">
                <input class="form-check-input" id="check_name" type="checkbox">
                <label class="form-check-label" style="margin-left: 5px;" for="check_name">Search by Name</label>
                <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="name" placeholder="Name" name="name" value="" style="margin-left: 5px;">  <span class="text-danger"></span>
              </div>
              <div class="form-check">
                <input class="form-check-input" id="check_phone" type="checkbox">
                <label class="form-check-label" style="margin-left: 5px;" for="check_phone">Search by Phone</label>
                <input type="text" class="form-control form-control-user @error('phone') is-invalid @enderror" id="phone" placeholder="Phone" name="phone" value="" style="margin-left: 5px;">  <span class="text-danger"></span>
              </div>  
              {{-- <div class="form-check">
                <input class="form-check-input" id="check_email" type="checkbox">
                <label class="form-check-label">Search by Email</label>
                <input type="text" class="form-control form-control-user @error('email') is-invalid @enderror" id="email" placeholder="Email" name="email" value="">  <span class="text-danger"></span>
              </div>   --}}
              <div class="form-check">
                <input class="form-check-input" id="check_nid" type="checkbox">
                <label class="form-check-label" style="margin-left: 5px;" for="check_nid">Search by NID</label>
                <input type="text" class="form-control form-control-user @error('email') is-invalid @enderror" id="nid" placeholder="" name="nid" value="" style="margin-left: 5px;">  <span class="text-danger"></span>
              </div>
              <div class="form-check">
                <input class="form-check-input" id="check_address" type="checkbox">
                <label class="form-check-label" style="margin-left: 5px;" for="check_address">Search by Address</label>
                <input type="text" class="form-control form-control-user @error('email') is-invalid @enderror" id="address" placeholder="" name="address" value="" style="margin-left: 5px;">  <span class="text-danger"></span>
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
              <!-- /.card-header -->
              <div class="card-body" style="overflow-x: scroll;">
            {{-- <div class="form-group row">
							<div class="col-sm-3 mb-3 mb-sm-0"> <span style="color:red;"></span>Name: </label>
								<input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="name" placeholder="" name="name" value=""> <span class="text-danger"></span>  </div> 
							<!-- <div class="col-sm-2 mb-2 mb-sm-0"> <span style="color:red;">*</span>Status: </label>
								<input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="email" placeholder="Status" name="status" value="">  <span class="text-danger"></span> </div>  -->
							<div class="col-sm-3 mb-3 mb-sm-0"> <span style="color:red;"></span>Phone: </label>
								<input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="phone" placeholder="" name="phone" value="">  <span class="text-danger"></span> </div> 
              <!-- <div class="col-sm-2 mb-2 mb-sm-0 input-daterange"> <span style="color:red;">*</span>From Date </label>
                <input type="date" class="form-control form-control-user @error('name') is-invalid @enderror" id="from_date" placeholder="" name="from_date" value="">  <span class="text-danger"></span> </div> 
              <div class="col-sm-2 mb-2 mb-sm-0 input-daterange"> <span style="color:red;">*</span>To Date </label>
                <input type="date" class="form-control form-control-user @error('name') is-invalid @enderror" id="to_date" placeholder="" name="to_date" value="">  <span class="text-danger"></span> </div>  -->
                <div class="col-sm-4 mb-4 mb-sm-0"> <span style="color:red;"></span>Date Registers: </label>
								<input type="text" class="form-control float-right" id="reservation" placeholder="" name="reservation" value="">  <span class="text-danger"><i class="far fa-calendar-alt"></i></span> </div> 
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
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Registered Date</th>
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
<!-- AdminLTE App -->
<script src="../../plugins/moment/moment.min.js"></script>
<script src="../../dist/js/adminlte.min.js"></script>
<script src="../../plugins/daterangepicker/daterangepicker.js"></script>
<!-- AdminLTE for demo purposes -->

<!-- Page specific script -->
<script>

$(document).ready(function(){
  fill_datatable("a");
  $('#reservation').daterangepicker().val('');

  function fill_datatable(name = '',action='',phone='',reservation = '',citizenId='')
  {
    var keywork = (name=='')?((phone=='')?((citizenId=='')?"":citizenId):phone):name;
    var type = (name=='')?((phone=='')?((citizenId=='')?"createAt":"citizenId"):"phone"):"name";
    var from = reservation.endDate;
    var to = "";
    var jsonData = [
      { "meta": { "version": 1, "type": "test" } }
    ];
    console.log(from);
    console.log(keywork);//"https://admin-voolo.herokuapp.com/v1/admin/searchBNPL"    url:"{{route('bnpl.dtajax')}}",
    var dataTable = $("#example1").DataTable({
        processing: true,
          serverSide: true,
          searching: false,
          language : {
              "zeroRecords": " "             
          },
          ajax: {
            url:"{{route('bnpl.dtajax')}}",
            data:{
              search:type,
              value:keywork,
              from: from,
              to: to,
            }
          },
          columns: [
            {data: 'name', name: 'Name'},
            {data: 'phone', name: 'Phone'},
            {data: 'createdAt', name: 'Date Regis',
              render: function ( data, type, row ) {
                if ( type === 'display' || type === 'filter' ) {
                    var d = new Date( data );
                    return d.getDate() +'-'+ (d.getMonth()+1) +'-'+ d.getFullYear();
                }
                return data;}
            
            },
            
            {data:'sex',
              "searchable": false,
              "orderable":false,
              "render": function (data, type, row) {
                if (row.name === null) {
                  return "<i>Nhập Thông Tin<i>";
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
            // {
            //   "defaultContent": "<i>null</i>"
            // },
            {
                data: 'action', 
                name: 'action', 
                orderable: true, 
                searchable: true,
            },
          ]
      });
  }
 
// $('#name').on('change',function(){
//   var user = $('#name').val();
//   if(user != ''){
//     $('#reservation').daterangepicker().val('');
//   }
// });

$('#filter').click(function(){
    var name = $('#name').val();
    var phone = $('#phone').val();
    var reservation = $('#reservation').val();
    var citizenId = $('#nid').val();
    // var to = $("#reservation").data('daterangepicker').endDate.format('YYYY-MM-DD');
    // console.log(to);
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
        fill_datatable(name,action="search",phone,reservation,citizenId);
      }
    // $('#example1').DataTable().destroy();
    // fill_datatable(name,action="search",phone,reservation);
});

  $('#reset').click(function(){
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
      // if($('#check_email').prop('checked',true))
      // {
      //   $('#check_email').click();
      //   $('#email').hide();
      // }
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
      $("#filter").hide();
      $("#reset").hide();
      $('#example1').DataTable().destroy();
      fill_datatable("a");
  });
  $('#name').hide();
  $('#phone').hide();
  // $('#email').hide();
  $('#nid').hide();
  $('#address').hide();
  $("#filter").hide();
  $("#reset").hide();
  // check for name field
  $('#check_name').change(function()
  {
    $("#name").toggle();
    $("#name").val("");
    if($('#check_name').prop('checked'))
        {
          $("#filter").show();
          $("#reset").show();
        }
        else
        {
          if($('#check_nid').prop('checked') || $('#check_address').prop('checked') || $('#check_phone').prop('checked') )
          {
            $("#filter").show();
            $("#reset").show();
          }
          else
          {
            $("#filter").hide();
            $("#reset").hide();
          }
        }
  });
  // check for nid field
  $('#check_nid').change(function()
  {
    $("#nid").toggle();
    $("#nid").val("");
    if($('#check_nid').prop('checked'))
        {
          $("#filter").show();
          $("#reset").show();
        }
        else
        {
          if($('#check_name').prop('checked') || $('#check_address').prop('checked') || $('#check_phone').prop('checked') )
          {
            $("#filter").show();
            $("#reset").show();
          }
          else
          {
            $("#filter").hide();
            $("#reset").hide();
          }
        }
  });
// check for address field
  $('#check_address').change(function()
  {
    $("#address").toggle();
    $("#address").val("");
    if($('#check_address').prop('checked'))
        {
          $("#filter").show();
          $("#reset").show();
        }
        else
        {
          if($('#check_nid').prop('checked') || $('#check_name').prop('checked') || $('#check_phone').prop('checked'))
          {
            $("#filter").show();
            $("#reset").show();
          }
          else
          {
            $("#filter").hide();
            $("#reset").hide();
          }
        }
  });
// check for phone field
  $('#check_phone').change(function()
  {
    $("#phone").toggle();
    $("#phone").val("");
    if($('#check_phone').prop('checked'))
        {
          $("#filter").show();
          $("#reset").show();
        }
        else
        {
          if($('#check_nid').prop('checked') || $('#check_address').prop('checked') || $('#check_name').prop('checked'))
          {
            $("#filter").show();
            $("#reset").show();
          }
          else
          {
            $("#filter").hide();
            $("#reset").hide();
          }
        }
  });
// check for email field
  // $('#check_email').change(function()
  // {
  //   $("#email").toggle();
  //   $("#email").val("");
  // });
  report();
  setInterval(function(){
    report() // this will run after every 5 seconds
}, 300000);
  function report(){
    
    $(this).load('{{env("API_PARTNER")}}/v1/admin/getReportBNPL',function (res) {
      var response = $.parseJSON(res);
      $(".total").text(response.data.total);
      $(".step2").text(response.data.step2);
      $(".step3").text(response.data.step3);
      $(".step4").text(response.data.step4);
    });
  }
});

  
</script>

@stop