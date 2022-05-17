

@extends('layouts.app')
@section('title', 'BNPL Registrations')
@section('css')


  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="../../plugins/bs-stepper/css/bs-stepper.min.css">
  {{-- Style forr toast  --}}
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" 
     href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
@stop

@section('content_header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0"> BNPL Registrations</h1>
            <small class="text-muted"><cite title="Source Title">BNPL Registrations Listing</cite></small>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">BNPL Registrations</li>
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
                <p>Total BNPL Registrations</p>
              </div>
              <div class="icon">
              <i class="fas fa-user-plus"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success box-step2" style="cursor:pointer">
              <div class="inner">
                <h3 class="step2">{{count($name)}}</h3>
                <p>Stage: Input Information</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-check"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6  box-step3">
            <!-- small box -->
            <div class="small-box bg-warning" style="cursor: pointer">
              <div class="inner">
                <h3 class="step3"> {{count($phone)}}</h3>
                <p>Stage: Setup PIN Code</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-lock"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6  box-step0" style="cursor: pointer">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3 class="step4">{{count($identify)}}</h3>
                <p>Stage: Verify Registration</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-shield"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
        </div>
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
                      <input type="text" class="form-control form-control-user" id="nid" placeholder="NID" name="nid" value="" style="">
                    </div>
                  </div>
                  <div class="col-8">
                      <div class="input-group">
                      <button type="button" class="btn btn-default float-right" id="daterange-btn" style="width:100%" data-toggle="tooltip" title="Created date">
                      Created from :   <span>Date range picker</span> <i class="far fa-calendar-alt"></i>
                      </button>
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
              <!-- /.card-header -->
              <div class="card-body" style="overflow-x: scroll;">
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
<script src="../../plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="../../plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="../../plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- BS-Stepper -->
<script src="../../plugins/bs-stepper/js/bs-stepper.min.js"></script>
<!-- dropzonejs -->
<script src="../../plugins/dropzone/min/dropzone.min.js"></script>
<!-- AdminLTE for demo purposes -->

<!-- Page specific script -->
<script>

$(document).ready(function(){

  $("[rel=tooltip]").tooltip({ placement: 'right'});
  $('[data-toggle="tooltip"]').tooltip();
  var today = new Date();
  $('#reservationdateto').datetimepicker({
      format: 'L',
      defaultDate:today
  });
  $('#reservationdate').datetimepicker({
      format: 'L',
      defaultDate:today.setFullYear(today.getFullYear() - 1)
  });


  fill_datatable("a");
  $('#reservation').daterangepicker().val('');

  function fill_datatable(name = '',action='',phone='',reservation = '',citizenId='')
  {
    var keywork = (name=='')?((phone=='')?((citizenId=='')?"":citizenId):phone):name;
    var type = (name=='')?((phone=='')?((citizenId=='')?"createAt":"citizenId"):"phone"):"name";
    var from = $('#dateString').val().split(" - ")[0];
    var to = $('#dateString').val().split(" - ")[1];
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
                return "<i>Xác minh thông tin<i>";
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
          ],
        drawCallback:function(setting){
          $('[data-toggle="tooltip"]').tooltip();
        }
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
      var email = $('#email').val();
      var reservation = $('#dateString').val();
      var citizenId = $('#nid').val();
      if( name == '' && phone == '' && citizenId == ''  && email == '' )
      {
        toastr["error"]("Please input data to search!")
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
        $('#classDatatable').show();
        $('#example1').DataTable().destroy();
        fill_datatable(name,action="search",phone,reservation,citizenId);
      }
  });

  $('#reset').click(function(){
    $('#classDatatable').hide();
    $('#name').val('');
      $('#email').val('');
      $('#phone').val('');
      $('#nid').val('');
      $('#reservation').daterangepicker({
        startDate: moment().subtract(1, 'year'),
        endDate  : moment()
      });
      $('#example1').DataTable().destroy();
      fill_datatable('a');
  });

  $('#daterange-btn').daterangepicker(
       {
          startDate: moment().subtract('days', 29),
          endDate: moment(),
          minDate: '01/01/2012',
          maxDate: '12/31/2022',
          dateLimit: { days: 60 },
          showDropdowns: true,
          showWeekNumbers: true,
          timePicker: false,
          timePickerIncrement: 1,
          timePicker12Hour: true,
          ranges: {
             'Last 7 Days': [moment().subtract('days', 6), moment()],
             'Last 30 Days': [moment().subtract('days', 29), moment()],
             'This Month': [moment().startOf('month'), moment().endOf('month')],
             'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')],
             'Last 3 Months': [moment().subtract('month', 3).startOf('month'), moment().subtract('month')]
          },
          opens: 'left',
          buttonClasses: ['btn btn-default'],
          applyClass: 'btn-small btn-primary',
          cancelClass: 'btn-small',
          format: 'DD/MM/YYYY',
          separator: ' to ',
          locale: {
              applyLabel: 'Submit',
              fromLabel: 'From',
              toLabel: 'To',
              customRangeLabel: 'Custom Range',
              daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
              monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
              firstDay: 1
          }
       },
       function(start, end) {

        $('#daterange-btn span').html(start.format('D MMMM YYYY') + ' - ' + end.format('D MMMM YYYY'));
        startDate = start;
         endDate = end;    
         $("#dateString").val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
         console.log(startDate);
        //  console.log(endDate);
        
       }
    );
    //Set the initial state of the picker label
    $('#daterange-btn span').html(moment().subtract('days', 29).format('D MMMM YYYY') + ' - ' + moment().format('D MMMM YYYY'));
    report();
    setInterval(function(){
        report() // this will run after every 5 seconds
    }, 300000);
  function report(){
    
    $(this).load('{{route("report")}}',function (res) {
       console.log(res);
       var response = $.parseJSON(res);
      $(".total").text(response.data.total);
      $(".step2").text(response.data.step2);
      $(".step3").text(response.data.step3);
      $(".step4").text(response.data.step4);
    });
  }

  $(".box-step2").on("click",function (e){
    e.preventDefault();
    console.log("filter step 2");
    // fill_datatable(name,action="search",phone,reservation,citizenId);
  });

  $(".box-step3").on("click",function (e){
    e.preventDefault();
    console.log("filter step 3");
    // fill_datatable(name,action="search",phone,reservation,citizenId);
  });
});

  
</script>

@stop