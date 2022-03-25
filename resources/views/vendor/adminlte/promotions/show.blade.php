@extends('layouts.app')
@section('title', 'Promotion')

@section('content_header')
<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Promotion Details</h1>
    <a href="{{route('promotions.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
    class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
  </div>
</div>
  @endsection
@section('content')
<section class="content">
  <div class="card">
    <div class="card-header p-2">
      <ul class="nav nav-pills">
        <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Details</a></li>
      </ul>
    </div><!-- /.card-header -->
    <div class="card-body">
      <div class="tab-content">
        <div class="active tab-pane" id="activity">
          <!-- Post -->
          <table id="example1" class="table table-bordered table-striped">
            <div class="tab-pane" id="settings">
              <form class="form-horizontal">
                <div class="form-group row">
                  <label for="title" class="col-sm-2 col-form-label">Title :</label>
                  <div class="col-sm-10">
                    <p type="text" class="form-control" id="title" placeholder="">{{$promotions->Title}}</p>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="title" class="col-sm-2 col-form-label">Description :</label>
                  <div class="col-sm-10">
                    <p type="text" class="form-control" id="title" placeholder="">{{$promotions->Description}}</p>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="title" class="col-sm-2 col-form-label">Post Date :</label>
                  <div class="col-sm-10">
                    <p type="text" class="form-control" id="title" placeholder="">{{$promotions->created_at}}</p>
                  </div>
                </div>
              </form> 
                <!-- /.post -->
              </div>
                <!-- /.tab-content -->
              </div>
            </div>
            <!-- /.card-body -->
          </table>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </div>
</section>
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
<!-- <script>
var editor;
  $(function () {
    $("#example1").DataTable({
      processing: true,
        serverSide: true,
        "ajax": "{{ route('promotions.dtajax') }}",
        columns: [
          {data: 'Title', name: 'Title'},
          {data: 'Description', name: 'Description'},
          {data: 'created_at', name: 'Date Post'},
          {
                  data: 'action', 
                  name: 'action', 
                  orderable: true, 
                  searchable: true
          },
        ],
    }).buttons().container().appendTo('#example1_wrapper .col-md-6');
  });
</script> -->

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