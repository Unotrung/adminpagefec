@extends('layouts.app')

@section('title', 'FAQs')
@section('css')
{{-- Datatable --}}
<link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="../../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
    <!-- BS Stepper -->
<link rel="stylesheet" href="../../plugins/bs-stepper/css/bs-stepper.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
  {{-- for Import --}}
  {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
@stop

@section('content_header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-5">
            <h1 class="m-0">FAQs</h1>
            <small class="text-muted"><cite title="Source Title">FAQs listing</cite></small>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">FAQs</li>
            </ol>
          </div><!-- /.col -->
          {{-- @can('update') --}}
          <div class="col-sm-1">
          <a href="{{route('faqs.add')}}" class="float-sm-right align-items-middle d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-plus"></i> Add</a>
          </div><!-- /.col -->
          {{-- @endcan --}}
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

@stop


@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body" style="overflow-x: scroll;">
                <div class="row" style="margin-bottom: 20px;">
                  <div class="col-4">
                    <div class="input-group input-group-sm" id="st" name="st">
                      <select class="select2 custom-select custom-select-sm form-control form-control-sm" style="width: 100%;" id="status" name="delete_at">
                        <option value="">Active</option>
                        <option value="1">Inactive</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="input-group input-group-sm">
                      <select class="select2 custom-select custom-select-sm form-control form-control-sm" style="width: 100%;" id="cat" name="Category">
                        <option value="" >Category...  </option>
                        <option value="Dành cho khách hàng">Dành cho khách hàng</option>
                        <option value="Dành cho đối tác">Dành cho đối tác</option>
                        <option value="Dành cho nhà bán hàng">Dành cho nhà bán hàng</option>
                        <option value="For Customers">For Customers</option>
                        <option value="For Partners">For Partners</option>
                        <option value="For Retailers">For Retailers</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="input-group input-group-sm">
                      <select class="select2 custom-select custom-select-sm form-control form-control-sm" style="width: 100%;" id="language" name="Language">
                        <option value="" >Language...  </option>
                        <option value="Vietnamese">Vietnamese</option>
                        <option value="English">English</option>
                      </select>

                    </div>
                  </div>
                </div>

                <div class="row" style="margin-bottom: 20px;">
                  <div class="col-6">
                    <div class="input-group">
                      <button type="button" class="btn btn-default float-right" id="daterange-btn" style="width:100%">
                        Created Date From-To: <i class="far fa-calendar-alt"></i> <span> Date range picker</span>
                      </button>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="input-group input-group-sm">
                      <input type="search" class="form-control form-control-lg" id ="input" placeholder="Type your question here" value="">
                        <div class="input-group-append">
                          <button type="submit" class="btn btn-lg btn-default" id="search">
                          <i class="fa fa-search"></i>
                          </button>
                        </div>
                    </div>
                  </div>
                  <div class="col-sm-2 ">
                      <button type="button" name="reset" id="reset" class="btn btn-light w-100">Reset</button>
                      {{-- <div class="mt-4"></div> --}}
                  </div>
                </div>
                <div class="col-0" style="visibility: hidden;height: 1px;">

                  {{-- <input type="text" class="form-control datetimepicker-input" id="dateString" readonly/> --}}
                  <input type="text" value="" id="dateString">

                </div>
                <div class="col-sm-12">
                  <div class="btn btn-info btn-user btn-block" style="width:10%;margin-left: 90%;" onClick="checkSubmit(this.value)">
                    Import
                  </div>
                </div>
                <div class="modal" id="demoModal">
                  <div class="modal-dialog">
                    <div class="modal-content">
                    <!-- Modal Header -->
                      <div class="modal-header">
                        <h4 class="modal-title">Select File CSV Your Want To Import</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>
                      <div class="modal-body">
                        <form action="{{ route('faqs.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="file" name="file" class="form-control">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                      </div>
                      <!-- Modal footer -->
                    </div>
                  </div>
                </div>
              {{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Import CSV</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                    </div>
                </div>
              </div> --}}
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Question</th>
                    <th>Category</th>
                    <th>Ask Date</th>
                    <th>Status</th>
                    <th>Language</th>
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

@stop

@section('js')
<!-- DataTables  & Plugins -->
{{-- <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script> --}}

<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<!-- Bootstrap4 Duallistbox -->
{{-- <script src="../../plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script> --}}
<!-- InputMask -->
<script src="../../plugins/moment/moment.min.js"></script>
{{-- <script src="../../plugins/inputmask/jquery.inputmask.min.js"></script> --}}
<!-- date-range-picker -->
<script src="../../plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
{{-- <script src="../../plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script> --}}
{{-- <script src="../../plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script> --}}
<!-- BS-Stepper -->
{{-- <script src="../../plugins/bs-stepper/js/bs-stepper.min.js"></script> --}}
<!-- dropzonejs -->
<script src="../../plugins/dropzone/min/dropzone.min.js"></script>
<script src="../../plugins/select2/js/select2.full.min.js"></script>
{{-- for Import  --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> --}}
<script>
  $('#daterange-btn').daterangepicker(
       {
          startDate: moment().subtract('days', 29),
          endDate: moment(),
          minDate: '01/01/2022',
          maxDate: moment(),
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
        $('#daterange-btn span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
        startDate = start;
         endDate = end;
         $('#dateString').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
       }
    );
    //Set the initial state of the picker label
$('#daterange-btn span').html(moment().subtract('days', 29).format('DD/MM/YYYY') + ' - ' + moment().format('DD/MM/YYYY'));
$('#dateString').val(moment().subtract('days', 29).format('YYYY-MM-DD') + ' - ' + moment().format('YYYY-MM-DD'));
console.log($('#dateString').val());
$('.select2').select2();
fill_datatable();
var language = $('#language').val();
    console.log("language"+ language);
    var status = $('#status').val();
    console.log("status" + status);
    var cat = $('#cat').val();
    console.log("cat" +cat);
function fill_datatable(input,language,status,cat)
{
      var dateString = $('#dateString').val().split(" - ");
      console.log(dateString);
      from = dateString[0];
      to = dateString[1];
      $("#example1").DataTable({
        processing: true,
        dom: 'Bfrtip',
        "searching": false,
          serverSide: true,
          ajax:{
          url: "{{ route('faqs.dtajax') }}",
          timeout: 5000,
          data:{input:input,language:language,status:status,cat:cat}
          },
          columns: [
            {data: 'Question', name: 'Title',render: function(data){
              ab=data.replace(/&lt;/g,'<').replace(/&gt;/g,'>').replace(/(<(.*?)>|&\w+;)/g,'');
              return ab;
            }},
            {data: 'Category', name: 'Description'},
            {data: 'created_at', name: 'created_at',render: function ( data, type, row ) {
                  if ( type === 'display' || type === 'filter' ) {
                      var d = new Date( data );
                      return d.getDate() +'/'+ (d.getMonth()+1) +'/'+ d.getFullYear();
                  }
                  return data;}},
            {data: 'Status', name: 'Description', render: function(data){
              return (data==1)?"<span class='badge bg-danger'> Inactive</span>":"<span class='badge bg-success'> Active</span>";
            }},
            {data: 'Language', name: 'Description'},
            {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
            },
          ],
          columnDefs: [],
          buttons: [
              {
                  extend: 'collection',
                  text: 'Export',
                  buttons: [
                      'copy',
                      'excel',
                      'csv',
                      'pdf',
                      'print'
                  ]
              }
          ]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6');
}
$('#search').click(function(){

    var input = $('#input').val();
    var str = input.replace(/\s/g, '').length;
    console.log(str);
    if(str > 0) {
      var language = $('#language').val();
      console.log(language);
      var status = $('#status').val();
      console.log(status);
      var cat = $('#cat').val();
      console.log(cat);
      if( input == '')
      {
        toastr["error"]("Please select input data to search!")
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
        fill_datatable(input,language,status,cat);
      }
    }
    else
    {
      toastr["error"]("Your input can't just have only whitespace")
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
  });

  // $('#reset').click(function(){
  //     $('#input').val('');
  //     // $('#type').val('');
  //     $("#type").val("").change();
  //     $("#status").val("").change();
  //     // $('#status').val('');
  //     $('#example1').DataTable().destroy();
  //     fill_datatable();
  // });

  function checkSubmit(){
    //     var Answer = $('#summer_answer').val();
    //     Answer = Answer.replace(/<[\/]{0,1}(p)[^><]*>/ig,"");
    //     console.log(Answer);
    //     if(Answer == ""){
		// 	toastr["error"]("Please input Answer!")
		// }
		// toastr.options = {
		// 	"closeButton": false,
		// 	"debug": true,
		// 	"newestOnTop": false,
		// 	"progressBar": false,
		// 	"positionClass": "toast-top-right",
		// 	"preventDuplicates": false,
		// 	"onclick": null,
		// 	"showDuration": "300",
		// 	"hideDuration": "1000",
		// 	"timeOut": "5000",
		// 	"extendedTimeOut": "1000",
		// 	"showEasing": "swing",
		// 	"hideEasing": "linear",
		// 	"showMethod": "fadeIn",
		// 	"hideMethod": "fadeOut"
		// }
		// if(Answer != "")
		// {
			$("#demoModal").modal("show");
		// }

	}


  $('#status').change(function()
  {
    var input = $('#input').val();
    console.log(input);
    var language = $('#language').val();
    console.log(language);
    var status = $('#status').val();
    console.log(status);
    var cat = $('#cat').val();
    console.log(cat);
    $('#example1').DataTable().destroy();
    fill_datatable(input,language,status,cat);
  });

  $('#cat').change(function()
  {
    var input = $('#input').val();
    console.log(input);
    var language = $('#language').val();
    console.log(language);
    var status = $('#status').val();
    console.log(status);
    var cat = $('#cat').val();
    console.log(cat);
    $('#example1').DataTable().destroy();
    fill_datatable(input,language,status,cat);
  });

  $('#language').change(function()
  {
    var input = $('#input').val();
    console.log(input);
    var language = $('#language').val();
    console.log(language);
    var status = $('#status').val();
    console.log(status);
    var cat = $('#cat').val();
    console.log(cat);
    $('#example1').DataTable().destroy();
    fill_datatable(input,language,status,cat);
  });
</script>


@stop
