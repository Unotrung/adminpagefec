@extends('layouts.app')
@section('title', 'Provider')

@section('content_header')
<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Provider Details</h1>
    <a href="{{route('providers.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
    class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
  </div>
</div>
  @endsection
@section('content')
<section class="content">
  <div class="card">
<!-- /.card-header -->
    <div class="card-body">
      <div class="tab-content">
        <div class="active tab-pane" id="activity">
          <!-- Post -->
          <table id="example1" class="table table-bordered table-striped">
            <div class="tab-pane" id="settings">
              <form class="form-horizontal">
                <div class="form-group row">
                  <label for="title" class="col-sm-2 col-form-label">Name Provider :</label>
                  <div class="col-sm-10">
                    <p type="text"  id="title" placeholder="">{{$providers->provider}}</p>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="title" class="col-sm-2 col-form-label">Description :</label>
                  <div class="col-sm-10">
                    <p type="text"  id="title" placeholder="">{{$providers->address}}</p>
                  </div>
                </div>
                <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 col-form-label">Images</label>
                      <div class="col-sm-10">
                      <img class="col-md-10 fvalue" src="{{ asset("./ImagesProvider/$providers->Image") }} " alt="">
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


@stop