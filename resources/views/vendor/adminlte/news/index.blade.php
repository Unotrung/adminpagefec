@extends('layouts.app')

@section('title', 'News')
@section('css')
{{--
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css"
     href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css"> --}}


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

  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
@stop

@section('content_header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-5">
      <h1 class="m-0">News</h1>
      <small class="text-muted"><cite title="Source Title">News Listing</cite></small>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item active">News</li>
      </ol>
    </div><!-- /.col -->
    <div class="col-sm-1">
      <a href="{{route('news.add')}}" class="float-sm-right align-items-middle d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-plus"></i> Add</a>
      </div><!-- /.col -->
  </div><!-- /.container-fluid -->
</div><!-- /.row -->
@stop



@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row" style="margin-bottom: 10px;">
                    <div class=" col-12 input-group input-group-sm">
                        <input type="search" class="form-control form-control-lg" id ="input" placeholder="Type your keywords here" value="">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-lg btn-default" id="search">
                            <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-bottom: 15px;margin-top: 10px;">
                    {{-- <div class="col-4"> --}}
                        <div class=" col-6 input-group input-group-sm">
                            {{-- <select class="select2 custom-select custom-select-sm form-control form-control-sm" style="width: 100%;" id="type" name="type">
                                <option value="" >Select...  </option>
                                <option value="Hướng dẫn">Hướng dẫn</option>
                              <option value="Lỗi">Lỗi</option>
                              <option value="Bài viết">Bài viết</option>
                              <option value="Mua trước trả sau cùng VOOLO">Mua trước trả sau cùng VOOLO</option>

                            </select> --}}
                                <button type="button" class="btn btn-default float-right" id="daterange-btn" style="width:100%;height: 32px;">
                                    Created Date From-To: <i class="far fa-calendar-alt"></i> <span> Date range picker</span>
                                </button>
                          </div>

                    {{-- </div> --}}

                    {{-- <div class="col-4"> --}}
                        <div class=" col-6 input-group input-group-sm">
                            <select class="select2 custom-select custom-select-sm form-control form-control-sm" style="width: 100%;" id="status" name="status">
                              <option value="">Active</option>
                              <option value="1">Unactive</option>
                            </select>
                          </div>

                          <div class="col-0" >


                            {{-- <input type="text" class="form-control datetimepicker-input" id="dateString" readonly/> --}}
                            <input type="text" value="" id="dateString" name="dateString" style="visibility: hidden;">
                          </div>
                    {{-- </div> --}}

                </div>

                </div>
            </div>
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body" style="overflow-x: scroll;">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Order</th>
                    <th>Title</th>
                    <th>Language</th>
                    <th>Create day</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                  </tr>
                  </tbody>
                </table>
                {{-- {{csfr_field() }} --}}
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
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
      </section>
      <!-- /.content -->
  @stop

  @section('js')
  <!-- DataTables  & Plugins -->
  <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>

  <script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>


  <script src="../../plugins/pdfmake/pdfmake.min.js"></script>
  <script src="../../plugins/pdfmake/vfs_fonts.js"></script>
  <!-- Bootstrap4 Duallistbox -->
  <script src="../../plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
  <!-- InputMask -->
  <script src="../../plugins/moment/moment.min.js"></script>
  <script src="../../plugins/inputmask/jquery.inputmask.min.js"></script>
  <!-- date-range-picker -->
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


  <script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <script src="../../plugins/select2/js/select2.full.min.js"></script>


{{-- main --}}
  {{-- @section('js')


<!-- bootstrap color picker -->
<script src="../../plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../../plugins/moment/moment.min.js"></script>
  <script src="../../dist/js/adminlte.min.js"></script>
  <script src="../../plugins/daterangepicker/daterangepicker.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.16/sorting/datetime-moment.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.21/dataRender/datetime.js"></script>
  <script src="../../plugins/select2/js/select2.full.min.js"></script> --}}



  {{-- <script>

  var editor;
    $(function () {

      $("#example1").DataTable({
        processing: true,
          serverSide: true,
          dom: 'Bfrtip',
          "ajax": "{{ route('news.dtajax') }}",
          columns: [
            {data: 'Order', name: 'order'},
            {data: 'Title', name: 'title'},
            {data: 'Language', name: 'language'},
            {data: 'created_at', name: 'createday'},
            {data: 'Status', name: 'status', render: function(data){
            return (data==1)?"<span class='badge bg-danger'> Inactive</span>":"<span class='badge bg-success'> Active</span>";
            }},

            {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,

            },
          ],
          columnDefs: [ {
          targets: 3,
          render: $.fn.dataTable.render.moment('YYYY-MM-DDTHH:mm:ss.SSSSZ','DD/MM/YYYY' )
          } ,
          {
            targets:2,
            render: function(data, type, row, meta) {
              if (type === 'display') {
                data = typeof data === 'string' && data.length > 100 ? data.substring(0, 100) + '...' : data;
              }
                return data;
            }
          }],
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
    });
  </script> --}}

<script>
$(document).ready(function(){

    // var created_at = new Created();

    // $('#daterange-btn').daterangepicker({
    //     todayBtn: 'linked',
    //     format: 'yyyy-mm-dd',
    //     autoclose: true
    // });
// //function nay dang test
//     function dtajax(dateString)
//     {
//         $.ajax({
//             url:"{{route('news.dtajax')}}",
//             method:"POST",
//             data:{dateString:dateString
//                 },

//             })
//         }

    $('#daterange-btn').daterangepicker(
       {
          startDate: moment().subtract('days',29),
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
            var status = $('#status').val();
            console.log("status"+ status);
            var input = $('#input').val();
            console.log('input'+input);
            var dateString = $('#dateString').val().split(" - ");
            console.log('dateString'+dateString);
            from = dateString[0];
            to = dateString[1];


    // $(document).ready(function(){
        function fill_datatable(status,input,from,to)
        {
            var dateString = $('#dateString').val().split(" - ");
            console.log(dateString);
            from = dateString[0];
            to = dateString[1];
            $("#example1").DataTable({
                lengthChange: true,
                responsive: true,
                processing: true,
                searching: false,
                serverSide: true,
                ajax:{
                    url: "{{ route('news.dtajax') }}",
                    timeout: 5000,
                    data:{status:status,input:input,from:from,to:to},
                    // processData: false, contentType: false,
                },

                columns: [
                    {data: 'Order', name: 'order'},
                    {data: 'Title', name: 'title'},
                    {data: 'Language', name: 'language'},
                    {data: 'created_at', name: 'created_at',

                    render: function ( data, type, row) {
                  if ( type === 'display' || type === 'filter' ) {
                      var d = new Date( data );
                      return d.getDate() +'/'+ (d.getMonth()+1) +'/'+ d.getFullYear();
                    //   return moment(row.created_at).format('YYYY-MM-DD');
                      return data;}
                  }},
                    {data: 'Status', name: 'status', render: function(data){
                    return (data==1)?"<span class='badge bg-danger'> Inactive</span>":"<span class='badge bg-success'> Active</span>";
                    }},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true,
                    },
                ],
                columnDefs: [
                // {
                // targets: 3,
                // render: $.fn.dataTable.render.moment('YYYY-MM-DDTHH:mm:ss.SSSSZ','DD/MM/YYYY' )
                // } ,
                // {
                //   targets:2,
                //   render: function(data, type, row, meta) {
                //     if (type === 'display') {
                //       data = typeof data === 'string' && data.length > 100 ? data.substring(0, 100) + '...' : data;
                //     }
                //       return data;
                //   }
                // }

                //bo cai nay
                //   {
                //     targets: '_all',
                //     defaultContent: ""
                //   }
                ],
                drawCallback:function(setting)
                {
                    $('[data-toggle="tooltip"]').tooltip();
                }
            }).buttons().container().appendTo('#example1 .col-md-6:eq(0)');
        }
//  <script>
//     $(document).ready( function () {
//       $('#example1').DataTable(
//         {
//           "buttons": [ "excel", "pdf"]
//         }
//       ).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)') ;
//   } );



// function fill_datatable(input,status)
// {
//       var dateString = $('#dateString').val().split(" - ");
//       console.log(dateString);
//       from = dateString[0];
//       to = dateString[1];
//       $("#example1").DataTable({
//         processing: true,
//         dom: 'Bfrtip',
//         "searching": false,
//           serverSide: true,
//           ajax:{
//           url: "{{ route('news.dtajax') }}",
//           timeout: 5000,
//           data:{input:input,status:status}
//           },
//           columns: [
//             {data: 'Question', name: 'Title',render: function(data){
//               ab=data.replace(/&lt;/g,'<').replace(/&gt;/g,'>').replace(/(<(.*?)>|&\w+;)/g,'');
//               return ab;
//             }},
//             {data: 'Category', name: 'Description'},
//             {data: 'created_at', name: 'created_at',render: function ( data, type, row ) {
//                   if ( type === 'display' || type === 'filter' ) {
//                       var d = new Date( data );
//                       return d.getDate() +'/'+ (d.getMonth()+1) +'/'+ d.getFullYear();
//                   }
//                   return data;}},
//             {data: 'Status', name: 'Description', render: function(data){
//               return (data==1)?"<span class='badge bg-danger'> Inactive</span>":"<span class='badge bg-success'> Active</span>";
//             }},
//             {data: 'Language', name: 'Description'},
//             {
//                     data: 'action',
//                     name: 'action',
//                     orderable: true,
//                     searchable: true
//             },
//           ],
//           columnDefs: [],
//           buttons: [
//               {
//                   extend: 'collection',
//                   text: 'Export',
//                   buttons: [
//                       'copy',
//                       'excel',
//                       'csv',
//                       'pdf',
//                       'print'
//                   ]
//               }
//           ]
//       }).buttons().container().appendTo('#example1_wrapper .col-md-6');
// }


  $('#search').click(function()
    {
        var input = $('#input').val();
        var str = input.replace(/\s/g, '').length;
        console.log(input);
        if(str > 0)
        {
            var status = $('#status').val();
            console.log(status);
            var dateString = $('#dateString').val().split(" - ");
            console.log(dateString);
            from = dateString[0];
            to = dateString[1];

            // var pagename = $('#search').val();
            // console.log(pagename);


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
                fill_datatable(status,input,from,to);
            }
        }
        else
        {
            toastr["error"]("Your input can't just have only whitespace")
            toastr.options ={
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

            $('#status').change(function()
            {
                var input = $('#input').val();
                console.log(input);

                var status = $('#status').val();
                console.log(status);
                var dateString = $('#dateString').val().split(" - ");
                console.log(dateString);
                from = dateString[0];
                to = dateString[1];
                // console.log(create_at);
                // var input = $('#search').val();
                // console.log(input) = $('#search').val();
                $('#example1').DataTable().destroy();
                fill_datatable(status,input,from,to);
            });

            // $('#dateString').change(function() {
            $('#daterange-btn').on('apply.daterangepicker', function(ev, picker) {
                var dateString = $('#dateString').val().split(" - ");
                console.log(dateString);
                from = dateString[0];
                to = dateString[1];
                var input = $('#input').val();
                console.log(input);
                var status = $('#status').val();
                console.log(status);
                console.log('hello');
                $('#example1').DataTable().destroy();
                fill_datatable(status,input,from,to);
            });

// $('#daterange-btn').on('apply.dateString', function(ev, picker) {
//     var dateString = $('#dateString').val().split(" - ");
//     console.log(dateString);
//     from = dateString[0];
//     to = dateString[1];
//     console.log('hello');
//     var input = $('#input').val();
//     console.log(input);
//     var status = $('#status').val();
//     console.log(status);
//     $('#example1').DataTable().destroy();
//     fill_datatable(status,input,from,to);
// });

            // $('#type').change(function()
            // {
            //     var input = $('#input').val();
            //     console.log(input);
            //     var status = $('#status').val();
            //     console.log(status);
            //     var language = $('#create_at').val();
            //     // console.log(create_at);
            //     // var input = $('#search').val();
            //     // console.log(input) = $('#search').val();
            //     $('#example1').DataTable().destroy();
            //     fill_datatable(status,create_at,input);
            // });
});

  </script>

  @stop
