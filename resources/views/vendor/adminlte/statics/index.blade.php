@extends('layouts.app')

@section('title', 'Statics Page')
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
      <h1 class="m-0">Statics Page</h1>
      <small class="text-muted"><cite title="Source Title">Statics Page Listing</cite></small>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item active">Statics Page</li>
      </ol>
    </div><!-- /.col -->
    <div class="col-sm-1">
      <a href="{{route('statics.add')}}" class="float-sm-right align-items-middle d-sm-inline-block btn btn-sm btn-primary shadow-sm">
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
                {{-- <div class="col-4"> --}}
                    <div class=" col-4 input-group input-group-sm">
                        <select class="select2 custom-select custom-select-sm form-control form-control-sm" style="width: 100%;" id="type" name="type">
                            <option value="" >Select...  </option>
                            <option value="Hướng dẫn">Hướng dẫn</option>
                          <option value="Lỗi">Lỗi</option>
                          <option value="Bài viết">Bài viết</option>
                          <option value="Mua trước trả sau cùng VOOLO">Mua trước trả sau cùng VOOLO</option>

                        </select>
                      </div>
                {{-- </div> --}}

                {{-- <div class="col-4"> --}}
                    <div class=" col-4 input-group input-group-sm">
                        <select class="select2 custom-select custom-select-sm form-control form-control-sm" style="width: 100%;" id="status" name="status">
                          <option value="">Active</option>
                          <option value="1">Inactive</option>
                        </select>
                      </div>
                {{-- </div> --}}
                {{-- <div class="col-4"> --}}
                    <div class=" col-4 input-group input-group-sm">
                        <select class="select2 custom-select custom-select-sm form-control form-control-sm" style="width: 100%;" id="language" name="language">
                            <option value="" >Select Languague...  </option>
                          <option value="VI">VI</option>
                          <option value="EN">EN</option>
                        </select>
                      </div>
                {{-- </div> --}}






            </div>

            <div class="row" style="margin-bottom: 15px;margin-top: 10px;">
                <div class=" col-11 input-group input-group-sm">
                    <input type="search" class="form-control form-control-lg" id ="input" placeholder="Type your keywords here" value="">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-lg btn-default" id="search" style="height: 31px;">
                        <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
                <div class="col-sm-1">
                    <button type="button" name="reset" id="reset" class="btn btn-light w-100"  style="border-color: #e7e7e7;">Reset</button>
                    {{-- <div class="mt-4"></div> --}}
                </div>
            </div>




            </div>
        </div>

            <div class="card">
              <!-- /.card-header -->
              <div class="card-body" style="overflow-x: scroll;">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Page Name</th>
                    <th>Status</th>
                    <th>Type</th>
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
      <script>
        @if(Session::has('success'))
        toastr.options =
        {
          "closeButton" : true,
          "progressBar" : true
        }
        toastr.success("{{ session('success') }}");
        @endif
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
  <script src="../../plugins/moment/moment.min.js"></script>
  <script src="../../dist/js/adminlte.min.js"></script>
  <script src="../../plugins/daterangepicker/daterangepicker.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.16/sorting/datetime-moment.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.21/dataRender/datetime.js"></script>
  <script src="../../plugins/select2/js/select2.full.min.js"></script>

{{-- <script src="../../plugins/select2/js/select2.full.min.js"></script> --}}
<!-- Page specific script -->
<script>
$(document).ready(function(){
    fill_datatable();
    function fill_datatable(status,type,language,input)
    {
        $("#example1").DataTable({
            lengthChange: true,
            responsive: true,
            processing: true,
            searching: false,
            serverSide: true,
            ajax:{
                url: "{{ route('statics.dtajax') }}",
                timeout: 5000,
                data:{status:status,type:type,language:language,input:input},
                // processData: false, contentType: false,
            },

            columns: [
                {data: 'Pagename', name: 'pagename'},
                {data: 'Status', name: 'status', render: function(data){
                return (data==1)?"<span class='badge bg-danger'> Inactive</span>":"<span class='badge bg-success'> Active</span>";
                }},
                {data: 'Type', name: 'type'},
                {data: 'Language', name: 'language'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true,
                },
            ],
            columnDefs: [
                {
                targets: '_all',
                defaultContent: ""
                }
            ],
            drawCallback:function(setting)
            {
                $('[data-toggle="tooltip"]').tooltip();
            }
        }).buttons().container().appendTo('#example1 .col-md-6:eq(0)');
    }

    $('#search').click(function()
    {
        var input = $('#input').val();
        var str = input.replace(/\s/g, '').length;
        console.log(input);
        if(str > 0)
        {
            var status = $('#status').val();
            console.log(status);
            var type = $('#type').val();
            console.log(type);
            var language = $('#language').val();
            console.log(language);

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
                fill_datatable(status,type,language,input);
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
        var type = $('#type').val();
        console.log(type);
        var language = $('#language').val();
        console.log(language);
        // var input = $('#search').val();
        // console.log(input) = $('#search').val();
        $('#example1').DataTable().destroy();
        fill_datatable(status,type,language,input);
    });

    $('#type').change(function()
    {
        var input = $('#input').val();
        console.log(input);
        var type = $('#type').val();
        console.log(type);
        var status = $('#status').val();
        console.log(status);
        var language = $('#language').val();
        console.log(language);
        // var input = $('#search').val();
        // console.log(input) = $('#search').val();
        $('#example1').DataTable().destroy();
        fill_datatable(status,type,language,input);
    });

    $('#language').change(function()
    {
        var input = $('#input').val();
        console.log(input);
        var type = $('#type').val();
        console.log(type);
        var status = $('#status').val();
        console.log(status);
        var language = $('#language').val();
        console.log(language);
        // var input = $('#search').val();
        // console.log(input) = $('#search').val();
        $('#example1').DataTable().destroy();
        fill_datatable(status,type,language,input);
    });

    $('#reset').click(function(){
          $('#input').val('');
          // $('#type').val('');
          $("#type").val("").change();
          $("#status").val("").change();
          $("#language").val("").change();
          // $('#status').val('');
          $('#example1').DataTable().destroy();
          fill_datatable();
      });

});

</script>
@stop
