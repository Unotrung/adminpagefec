@extends('layouts.app')
@section('title', 'Users')
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
  <link rel="stylesheet" type="text/css" 
     href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <!-- Theme style -->
  <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
@stop
@section('content_header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-5">
      <h1 class="m-0">Users</h1>
      <small class="text-muted"><cite title="Source Title">Users listing</cite></small>
    </div><!-- /.col -->
    <div class="col-sm-5">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Users</li>
      </ol>
    </div><!-- /.col -->
    <div class="col-sm-2">
      <a href="{{route('users.create')}}" class="float-sm-right align-items-middle d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus"></i> Add</a>
      </div><!-- /.col -->
  </div><!-- /.container-fluid -->
</div><!-- /.row -->
@stop

@section('content')
    <!-- Main content -->
    <div class="container-fluid">
        <div class="row">
          <div class="col-6">
            <div class="input-group input-group-sm">
              <input type="search" class="form-control form-control-lg" id = "input" placeholder="Type your keywords here" >
                <div class="input-group-append">
                  <button type="submit" class="btn btn-lg btn-default" id="search">
                  <i class="fa fa-search"></i>
                  </button>
                </div>
            </div>
          </div>
          <div class="col-3">
            <div class="input-group input-group-sm">
              <select class="select2" style="width: 100%;" id="type">
                <option>Username</option>
                <option>Email</option>
                <option>Role</option>
                <option>Status</option>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body" >
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    {{-- <label for="status" style="width:20%; margin-left: 200px;">Choose status of user:</label>
                    <select id="status" style="width:30%; margin: right auto;">
                      <option value="" selected >Select status</option>
                      <option value="Active" >Active</option>
                      <option value="InActive" >InActive</option>
                  </select> --}}
                  <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Created Date</th>
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
    <!-- /.content -->
    <script>
      @if(Session::has('add'))
      toastr.options =
      {
        "closeButton" : true,
        "progressBar" : true
      }
          toastr.success("{{ session('add') }}");
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
<!-- AdminLTE for demo purposes -->
<script src="../../plugins/moment/moment.min.js"></script>
<script src="../../dist/js/adminlte.min.js"></script>
<script src="../../plugins/daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.16/sorting/datetime-moment.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.21/dataRender/datetime.js"></script>
<script src="../../plugins/select2/js/select2.full.min.js"></script>


<!-- Page specific script -->
<script>
$(document).ready(function(){
  
  fill_datatable();
  $('#reservation').daterangepicker().val('');
  function fill_datatable(input)
  {
    var table = $("#example1").DataTable({
      lengthChange: true, 
      responsive: true, 
      processing: true,
      searching: false,
        serverSide: true,
        ajax:{ 
          url: "{{ route('users.dtajax') }}",
          data:{input}
        },
        columns: [
          {data: 'name', name: 'name'},
          {data: 'email', name: 'email'},
          {data:'role',name:'Role'},
          {data: 'delete_at', name: 'status', render: function(data){
            if(status == 1)
            return (data==1)?"<span class='badge bg-danger'> Inactive</span>":"<span class='badge bg-success'> Active</span>";
          }},
          {data: 'created_at', name: 'created_at'},
          {
              data: 'action', 
              name: 'action', 
              orderable: true, 
              searchable: true,
          },
        ],
        columnDefs: [ {
        targets: 4,
        render: $.fn.dataTable.render.moment('YYYY-MM-DDTHH:mm:ss.SSSSZ','DD/MM/YYYY' )
        },{
          targets: '_all',
          defaultContent: ""
        }]
    });
    table.buttons().container().appendTo('#example1 .col-md-6:eq(0)');
  }

  $('#search').click(function(){
    var input = $('#input').val();
    console.log(input);
    var type = $('#type').val();
    console.log(type);
    var to_date = $('#to_date').val();
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
      fill_datatable(input);
    }
  });

  // $('#reset').click(function(){ 
  //     $('#name').val('');
  //     $('#email').val('');
  //     $('#status').val('');
  //     $('#role').val('');
  //     $('#reservation').val('');
  //     // $('#to_date').val('');
  //     $('#example1').DataTable().destroy();
  //     fill_datatable(); 
  // });

  $('#type').change(function()
  {
    var type = $('#type').val();
    console.log(type);
  });
  $('.select2').select2();
});





</script>

<!-- <script>
  $(document).ready( function () {
    $('#example1').DataTable(
      {
        "buttons": [ "excel", "pdf"]
      }
    ).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)') ;
} );
</script>  -->

@stop