@extends('layouts.app')

@section('title', 'Configuration')

@section('content_header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="h3 mb-0 text-gray-800">Configuration Setting</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Configuration</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
@stop

@section('content')  



<section class="content">
    <div class="container-fluid">
      <form method="post" action="{{ route('configuration.update.status') }}" id="configForm">
        @csrf
        <div class="row">
          <div class="col-12">
            <ul class="nav nav-tabs" id="custom-content-above-tab" role="tablist">
              {{-- <li class="nav-item">
                <a class="nav-link active" id="custom-content-above-home-tab" data-toggle="pill" href="#custom-content-above-home" role="tab" aria-controls="custom-content-above-home" aria-selected="true">Configuration</a>
              </li> --}}
            </ul>
            <!-- <div class="tab-custom-content">
              <p class="lead mb-0">"Information BNPL"</p>
            </div> -->
            <div class="tab-content" id="custom-content-above-tabContent">
              <div class="tab-pane fade show active" id="custom-content-above-home" role="tabpanel" aria-labelledby="custom-content-above-home-tab">
                  <!-- Horizontal Form -->
            <div class="card card-info">
                <div class="card-body">
                  {{-- <form method="get" action="{{route('configuration.update.status')}}"> --}}
                  <table class="table table-hover table-striped">
                    <tbody>
                      @foreach ($config as $configs)
                      <tr>
                        {{-- <th scope="row">{{ $configs->id }}</th> --}}
                        <input type="hidden" name="status[{{ $configs->_id }}]" value="0">
                        <td>{{ $configs->name }}</td>
                        <td><input type="checkbox" value="{{$configs->value}}" data-id="{{ $configs->_id }}" name="status[{{ $configs->_id }}]" class="js-switch" {{ $configs->value == 1 ? 'checked' : '' }}></td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
              {{-- </form> --}}
                </div>
              </div>
                </div>
                <!-- /.card-body -->
                <button type="submit" name="submit" class="btn btn-success btn-user btn-block" style="width:20%; display:block; margin: 0 auto;">
                  Save
                </button>
              </form>
                </div>
                <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
            
      <!-- /.timeline -->

    </section>
        </div>
<!-- /.card -->
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- Page specific script -->
<script>
let status = "";
let configId = "";
$(document).ready(function()
{
  $('.js-switch').change(function () {
        status = $(this).prop('checked') === true ? 1 : 0;
        configId = $(this).data('id');
        // $.ajax({
        //     type: "GET",
        //     dataType: "json",
        //     url: '{{ route('configuration.update.status') }}',
        //     data: {'status': status, 'config_id': configId},
        //     success: function (data) {
        //                 toastr.options.closeButton = true;
        //                 toastr.options.closeMethod = 'fadeOut';
        //                 toastr.options.closeDuration = 100;
        //                 toastr.success(data.message);
        //             }
        // });
        
    });
});

$(function () {
    $('button').on('click', function (e){
      
      console.log(status);
      console.log(configId);
      Swal.fire({
      title: 'Do you want to save the changes?',
      showDenyButton: true,
      showCancelButton: false,
      confirmButtonText: `Save`,
      denyButtonText: `Don't save`,
      }).then((result) => {
      if (result.isConfirmed) {
        // $.ajax({
        //   headers: {
        //   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        //   type: "GET",
        //   dataType: "json",
        //   url: '{{ route('configuration.update.status') }}',
        //   data: {'status': status, 'config_id': configId},
        //   success:function(response){
        //     Swal.fire('Saved!', '', 'success');
        //     console.log(response);
        //     // location.reload(true);
        // }
      // })
      } else if (result.isDenied) {
        Swal.fire('Changes are not saved', '', 'info')
        location.reload(true);
        e.preventDefault();
      }
  })
  })
});

let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

elems.forEach(function(html) {
    let switchery = new Switchery(html,  { size: 'small' });
});

</script>

@stop