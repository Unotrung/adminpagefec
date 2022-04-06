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
            <meta name="csrf-token" content="{{ csrf_token() }}">
              <!-- /.card-header -->
              <div class="card-body" style="overflow-x: scroll;">
                <table id="example1" class="table table-bordered table-striped" style="width:100%" cellspacing="0">
                  <thead>
                  <label for="users" style="width:15%; margin-left: 200px;">Choose a role:</label>
                <select id="user" style="width:30%; margin: right auto;">
                  @foreach ($roles as $role)
                  <option value="{{$role['id']}}">{{$role['name']}}</option>
                  @endforeach
                </select>
                  <tr>
                    <th width="40%">Module</th>
                    <th>View</th>
                    <th>Create</th>
                    <th>Update</th>
                    <th>Delete</th>
                    <th>Previlege Fields</th>
                  </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
                <fieldset class="fields">
                    <div class= "card">
                    <label for="coupon_field">Name</label>
                    <input type="text" name="coupon_field" id="coupon_field" style="width:40%"/>
                    <label for="coupon_field">Phone</label>
                    <input type="text" name="coupon_field" id="coupon_field" style="width:40%"/>
                    </div>
                  </fieldset>
              </div>
              <!-- /.card-body -->
            </div>
            <button type="submit" name="submit" class="btn btn-success btn-user btn-block" style="width:20%; display:block; margin: 0 auto;">
                    Save
            </button>
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
$(".fields").hide();
  $(function () {
    var table = $("#example1").DataTable({
      processing: true,
        serverSide: true,
        "ajax": "{{ route('modules.dtajax') }}",
        columns: [
          {data: 'module', name: 'module'},
          {
              data: 'module', 
              name: 'action', 
              targets: 0,
              orderable: false, 
              searchable: false,
              render: function (data, type, row, meta){
                return '<input type="checkbox" name="View" value="'+ data +'" onclick="handleClick(this.value,this.name);">';
              }
          },
          {
              data: 'module', 
              name: 'action', 
              orderable: false, 
              searchable: false,
              render: function (data, type, full, meta){
                return '<input type="checkbox" id="checkbox2" name="Create" value="'+ data +'" onclick="handleClick(this.value,this.name);">';
              }
          },
          {
              data: 'module', 
              name: 'action', 
              orderable: false, 
              searchable: false,
              render: function (data, type, row, meta){
                return '<input type="checkbox" id="checkbox3" name="Update"  value="'+ data +'" onclick="handleClick(this.value,this.name);">';
              }
          },
          {
              data: 'module', 
              name: 'action', 
              orderable: false, 
              searchable: false,
              render: function (data, type, full, meta){
                return '<input type="checkbox" id="checkbox4" name="Delete"  value="'+ data +'" onclick="handleClick(this.value,this.name);">';
              }
          },
          {
              data: 'module', 
              name: 'action', 
              orderable: false, 
              searchable: false,
              render: function (data, type, row, meta){
                return '<input id="checkbox5" class="toggle-adv-access btn btn-default btn-sm hide_row" type="checkbox" name="check['+data+']" value="'+row+'" onclick="FieldsClick(this.name);">';        
              }
          },
        ],
    }).buttons().container().appendTo('#example1_wrapper .col-md-6');
});
var permission_list = [];
var total = {};
var role_id = {};
var id = "";

function handleClick(value,name) {
  if($('input[name="'+name+'"]').is(":checked")){  
    if(permission_list.includes(value.toLowerCase() +"-"+name.toLowerCase()) === false){
      permission_list.push(value.toLowerCase() +"-"+name.toLowerCase());
    }
  }
  else{
    permission_list.pop(value);
  }
}

$(function () {
    $("select").on('change',function(){
        var selectedCountry = $(this).children("option:selected").val();
          id = $(this).val();
          console.log({ id,"permissions":permission_list });
    });
});

function FieldsClick(name) {
  if($('input[name="'+name+'"]').is(":checked")){
    $(".fields").show();
  }
  else{
    $(".fields").hide();
  }
}

$(function () {
  $('button').on('click', function (){
    $.ajax({
      headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      type: "POST",
      url: "{{ route('modules.givepermission') }}",
      data: { id,"permissions":permission_list },
      success:function(response){
    }
  })
})
});
</script>

@stop