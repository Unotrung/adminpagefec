@extends('layouts.app')

@section('title', 'Modules')
@section('css')
<style>
.box {
  display: none;
}
</style>


  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">

@stop
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-12">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <h1 class="h3 mb-0 text-gray-800">Modules</h1>
              <a href="{{route('modules.add')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                  <i class="fas fa-plus"></i> Add New
              </a>
          </div>
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body" style="overflow-x: scroll;">
                <table id="example1" class="table table-bordered table-striped" style="width:100%" cellspacing="0">
                  <thead>
                  <tr>
                    <th width="40%">Module</th>
                    <th>View</th>
                    <th>Create</th>
                    <th>Update</th>
                    <th>Delete</th>
                    <th>Previlege Fields</th>
                  </tr>
                  </thead>
                  <tbody >
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
<!-- AdminLTE for demo purposes -->

<!-- Page specific script -->
<script>
var editor;
var table = "";
  $(function () {
    let table = $("#example1").DataTable({
      processing: true,
        serverSide: true,
        "ajax": "{{ route('modules.dtajax') }}",
        columns: [
          {data: 'module', name: 'module'},
          {
              data: 'module', 
              name: 'action', 
              orderable: false, 
              searchable: false,
              render: function (data, type, full, meta){
                return '<input type="checkbox" id="checkbox1" value="View '+ data +'"  onclick="handleClick(this.value,this.id);">';
              }
          },
          {
              data: 'module', 
              name: 'action', 
              orderable: false, 
              searchable: false,
              render: function (data, type, full, meta){
                return '<input type="checkbox" id="checkbox2" value="Create '+ data +'" onclick="handleClick(this.value,this.id);">';
              }
          },
          {
              data: 'module', 
              name: 'action', 
              orderable: false, 
              searchable: false,
              render: function (data, type, full, meta){
                return '<input type="checkbox" id="checkbox3" value="Update '+ data +'" onclick="handleClick(this.value,this.id);">';
              }
          },
          {
              data: 'module', 
              name: 'action', 
              orderable: false, 
              searchable: false,
              render: function (data, type, full, meta){
                return '<input type="checkbox" id="checkbox4" value="Delete '+ data +'" onclick="handleClick(this.value,this.id);">';
              }
          },
          {
              data: 'module', 
              name: 'action', 
              orderable: false, 
              searchable: false,
              render: function (data, type, full, meta){
                return '<input id="checkbox5" class="toggle-adv-access btn btn-default btn-sm hide_row" type="checkbox" name="checkbox5" value="'+data+'" onclick="handleClick(this.name);">';        
              }
          },
        ],
    }).buttons().container().appendTo('#example1_wrapper .col-md-6');
});
for (var i = 0; i <= $("#example1_wrapper").length; i++){
  function handleClick(value,id) {
  console.log($("#example1").length);
  if(document.getElementById(id).checked){
    $(".box").show();
    console.log(value);
  }
  else {
    $(".box").hide();
  }
}

};

</script>

@stop