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
  <link rel='stylesheet' href='https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.css'>

@stop
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-12">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <h1 class="h3 mb-0 text-gray-800">Modules</h1>
              <a href="{{route('modules.add')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                  <i class="fas fa-plus"></i> Add
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
                <option value="" selected>Select a role</option>
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
 
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
var id = "";
var role_data = <?php echo $roles?>;
var per_data = <?php echo $permissions?>;
var existed_per = [];
var table = "";

$(".fields").hide();
  $(function () {
    table = $("#example1").DataTable({
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
                  const str = data.toLowerCase() + "-" + "view";    
                  var checked = '';
                  if(existed_per.includes(str)){
                    checked = 'checked';
                  }else{
                    checked = '';
                  }
                  return '<input type="checkbox" name="view" value="'+ data.toLowerCase() +'" onclick="handleClick(this.value,this.name);" '+checked+' >';
              }
          },
          {
              data: 'module', 
              name: 'action', 
              orderable: false, 
              searchable: false,
              render: function (data, type, full, meta){
                const str = data.toLowerCase() + "-" + "create";    
                  var checked = '';
                  if(existed_per.includes(str)){
                    checked = 'checked';
                  }else{
                    checked = '';
                  }
                  return '<input type="checkbox" name="create" value="'+ data.toLowerCase() +'" onclick="handleClick(this.value,this.name);" '+checked+' >';
              }
          },
          {
              data: 'module', 
              name: 'action', 
              orderable: false, 
              searchable: false,
              render: function (data, type, row, meta){
                const str = data.toLowerCase() + "-" + "update";    
                  var checked = '';
                  if(existed_per.includes(str)){
                    checked = 'checked';
                  }else{
                    checked = '';
                  }
                  return '<input type="checkbox" name="update" value="'+ data.toLowerCase() +'" onclick="handleClick(this.value,this.name);" '+checked+' >';
              }
          },
          {
              data: 'module', 
              name: 'action', 
              orderable: false, 
              searchable: false,
              render: function (data, type, full, meta){
                const str = data.toLowerCase() + "-" + "delete";    
                  var checked = '';
                  if(existed_per.includes(str)){
                    checked = 'checked';
                  }else{
                    checked = '';
                  }
                  return '<input type="checkbox" name="delete" value="'+ data.toLowerCase() +'" onclick="handleClick(this.value,this.name);" '+checked+' >';
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

function handleClick(value,name) {
  if($('input[name="'+name+'"]').is(":checked")){  
    if(existed_per.includes(value.toLowerCase() +"-"+name.toLowerCase()) === false){
      existed_per.push(value.toLowerCase() +"-"+name.toLowerCase());
    }
  }
  else{
    existed_per = jQuery.grep(existed_per,function(e) {
      return e != value.toLowerCase() +"-"+name.toLowerCase();
    });
  }
}

function FieldsClick(name) {
  if($('input[name="'+name+'"]').is(":checked")){
    $(".fields").show();
  }
  else{
    $(".fields").hide();
  }
}

$(function () {
  $("select").on('change',function(){
    existed_per = []; 
      var selectedCountry = $(this).children("option:selected").val();
        id = $(this).val();
        $.each(role_data, function(index, value) {
        if(id == value._id){
          var permission_id = value.permission_ids;
            $.each(permission_id, function(index, value) {
              var ele_id = value;
              $.each(per_data, function(index, value) {
              if(ele_id == value._id){
                existed_per.push(value.name)
              }
            })
          })
        }
      })
      console.log(existed_per);
      $('#example1').DataTable().ajax.reload();
    });
});

$(function () {
  $('button').on('click', function (){
    Swal.fire({
    title: 'Do you want to save the changes?',
    showDenyButton: true,
    showCancelButton: false,
    confirmButtonText: `Save`,
    denyButtonText: `Don't save`,
    }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: "POST",
        url: "{{ route('modules.givepermission') }}",
        data: { id,"permissions":existed_per },
        success:function(response){
          Swal.fire('Saved!', '', 'success')
          location.reload(true);
      }
    })
    } else if (result.isDenied) {
      Swal.fire('Changes are not saved', '', 'info')
      location.reload(true);
    }
})
})
});
</script>

@stop