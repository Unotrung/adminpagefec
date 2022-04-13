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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" 
     href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
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
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body" >
                <table id="example1" class="table table-bordered table-striped">
                  <div class="form-group row">
							<div class="col-sm-2 mb-2 mb-sm-0"> <span style="color:red;"></span>Username: </label>
								<input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="name" placeholder="" name="name" value=""> <span class="text-danger"></span>  </div> 
							<div class="col-sm-2 mb-2 mb-sm-0"> <span style="color:red;"></span>Email: </label>
								<input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="email" placeholder="" name="email" value="">  <span class="text-danger"></span> </div> 
                <div class="col-sm-2 mb-2 mb-sm-0"> <span style="color:red;"></span>Role: </label>
                  <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="role" placeholder="" name="role" value=""> <span class="text-danger"></span>  </div> 
                <div class="col-sm-2 mb-2 mb-sm-0"> <span style="color:red;"></span>Status: </label>
								<input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="status" placeholder="" name="status" value="">  <span class="text-danger"></span> </div> 
               <div class="col-sm-2 mb-2 mb-sm-0"> <span style="color:red;"></span>Created Date </label>
								<input type="text" class="form-control float-right" id="reservation" placeholder="" name="reservation" value="">  <span class="text-danger"><i class="far fa-calendar-alt"></i></span> </div> 
              <div class="col-sm-1 mb-1 mb-sm-0 p-0">
                <div class="mt-4"></div>
                  <button type="button" name="filter" id="filter" class="btn btn-info w-100">Search</button>
						  </div>
              <div class="col-sm-1 mb-1 mb-sm-0 pl-1">
                <div class="mt-4"></div>
                  <button type="button" name="reset" id="reset" class="btn btn-default w-100">Reset</button>
              </div>
            </div>
                  <thead>
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

<!-- Page specific script -->
<script>
$(document).ready(function(){
  fill_datatable();
  $('#reservation').daterangepicker().val('');
  function fill_datatable(name = '',email=  '',action='',status='',reservation = '',role='')
  {
    var table = $("#example1").DataTable({
      lengthChange: true, 
      responsive: true, 
      processing: true,
      searching: false,
        serverSide: true,
        ajax:{ 
          url: "{{ route('users.dtajax') }}",
          data:{name:name , email:email , action:action , status:status ,reservation:reservation}
        },
        columns: [
          {data: 'name', name: 'name'},
          {data: 'email', name: 'email'},
          {data:'role',name:'Role'},
          {data: 'delete_at', name: 'status', render: function(data){
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
        } ]
    });
    table.buttons().container().appendTo('#example1 .col-md-6:eq(0)');
  }

  $('#filter').click(function(){
    var name = $('#name').val();
    var email = $('#email').val();
    var role = $('#role').val();
    var status = $('#status').val();
    var reservation = $('#reservation').val();
    // var to_date = $('#to_date').val();
    if((reservation != '' &&  name == '')||(reservation != '' &&  status == '' )||(reservation != '' &&  email == '' ))
    {
      toastr["error"]("Please select Full name or Email or Status to search!")
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
      fill_datatable(name,email,role,action="search",status,reservation);
    }
  });

  $('#reset').click(function(){ 
      $('#name').val('');
      $('#email').val('');
      $('#status').val('');
      $('#role').val('');
      $('#reservation').val('');
      // $('#to_date').val('');
      $('#example1').DataTable().destroy();
      fill_datatable();
  });

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