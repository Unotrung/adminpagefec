@extends('layouts.app')
@section('title', 'Dashboard')
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
@stop
@section('content_header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">BNPL Registrations</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">BNPL</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
@stop

@section('content')

    <!-- Main content -->
    <section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="overflow-x: scroll;">

                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Customer name</th>
                    <th>Phone</th>
                    <th>Image</th>
                    <th>NID</th>
                    <th>NID Image</th>
                    <th>Gender</th>
                    <th>Pin Code</th>
                    <th>DOB</th>
                    <th>DON</th>
                    <th>Date Regis</th>
                    <th>Address</th>
                    <th>Code</th>
                    <th>Code Name</th>
                    <th>Division Type</th>
                    <th>District</th>
                    <th>Type Relation</th>
                    <th>Phone Relation</th>
                    <th>Name Relation</th>
                    <th>Contract</th>
                    <th>Action</th>
                    <th>Stage</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($bnpl as $bnpl)
                  <tr>
                    <td>{{$bnpl->ncustomer}}</td>
                    <td>{{$bnpl->phnumber}}</td>
                    <td>{{$bnpl->image}}</td>
                    <td>{{$bnpl->nidcustomer}}</td>
                    <td>{{$bnpl->nidimage}}</td>
                    <td>{{$bnpl->Gender}}</td>
                    <td>{{$bnpl->Pincode}}</td>
                    <td>{{$bnpl->DOB}}</td>
                    <td>{{$bnpl->DON}}</td>
                    <td>{{$bnpl->DRegis}}</td>
                    <td>{{$bnpl->Address}}</td>
                    <td>{{$bnpl->Code}}</td>
                    <td>{{$bnpl->CodeName}}</td>
                    <td>{{$bnpl->DivisionType}}</td>
                    <td>{{$bnpl->District}}</td>
                    <td>{{$bnpl->TypeRelation}}</td>
                    <td>{{$bnpl->PhoneRelation}}</td>
                    <td>{{$bnpl->NameRelation}}</td>
                    <td>{{$bnpl->Contract}}</td>
                    <td><a href="{{action([App\Http\Controllers\BnplController::class, 'edit'],$bnpl->id)}}" method="GET" class="btn btn-warning">Edit</a></td>
                    <td>
                      @if(!$bnpl->ncustomer == null && !$bnpl->Pincode == null && !$bnpl->Contract == null)
                          Xác Minh Thông Tin
                      @elseif(!$bnpl->ncustomer == null && !$bnpl->Pincode == null && $bnpl->Contract == null)
                          Xác nhận hợp đồng 
                      @elseif(!$bnpl->ncustomer == null && $bnpl->Pincode == null && $bnpl->Contract == null)
                          Cài đặt Pin Code
                      @else
                          Nhập Thông Tin    
                      @endif
                    </td>
                    <td>Waiting</td>
                  </tr>
                  @endforeach
                  <!-- <tr>
                    <td>11974846f3d5e27b41d2d1c9e31364e3</td>
                    <td>a3ca7aee3e8816145b8fd56791bac66c
                    </td>
                    <td>11/02/1988</td>
                    <td>4cc859b7282b9a05ea622e2f08c137dc</td>
                    <td>Nam</td>
                    <td>e-Sign</td>
                  </tr>
                  <tr>
                    <td>11974846f3d5e27b41d2d1c9e31364e3</td>
                    <td>a3ca7aee3e8816145b8fd56791bac66c
                    </td>
                    <td>31/01/1992</td>
                    <td>4cc859b7282b9a05ea622e2f08c137dc</td>
                    <td>Nữ</td>
                    <td>Fail</td>
                  </tr>
                  <tr>
                    <td>11974846f3d5e27b41d2d1c9e31364e3</td>
                    <td>a3ca7aee3e8816145b8fd56791bac66c
                    </td>
                    <td>01/02/1992</td>
                    <td>4cc859b7282b9a05ea622e2f08c137dc</td>
                    <td>Nữ</td>
                    <td>Fail</td>
                  </tr>
                  <tr>
                    <td>11974846f3d5e27b41d2d1c9e31364e3</td>
                    <td>a3ca7aee3e8816145b8fd56791bac66c
                    </td>
                    <td>01/02/1992</td>
                    <td>4cc859b7282b9a05ea622e2f08c137dc</td>
                    <td>Nam</td>
                    <td>Fail</td>
                  </tr>
                  <tr>
                    <td>11974846f3d5e27b41d2d1c9e31364e3</td>
                    <td>a3ca7aee3e8816145b8fd56791bac66c
                    </td>
                    <td>01/02/1992</td>
                    <td>4cc859b7282b9a05ea622e2f08c137dc</td>
                    <td>Nữ</td>
                    <td>e-KYC checking</td>
                  </tr> -->
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
 
<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
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
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->

<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
@stop