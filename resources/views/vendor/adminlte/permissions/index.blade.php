@extends('layouts.app')

@section('title', 'Permissions')

@section('content_header')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Permissions</h1>
        <a href="{{route('permission.add')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus"></i> Add
        </a>
    </div>
</div> 
@stop
@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Permissions</h6>
        </div>
          <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="example1" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Guard Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>      


@endsection

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

<!-- Page specific script -->
<script>
var editor;
  $(function () {
    $("#example1").DataTable({
      processing: true,
        serverSide: true,
        "ajax": "{{ route('permission.dtajax') }}",
        columns: [
          {data: 'display_name', name: 'name'},
          {data: 'guard_name', name: 'guard_name'},
          {
                  data: 'action', 
                  name: 'action', 
                  orderable: true, 
                  searchable: true
          },
        ],
        columnDefs: [{
          targets: '_all',
          defaultContent: ""
        }]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6');
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