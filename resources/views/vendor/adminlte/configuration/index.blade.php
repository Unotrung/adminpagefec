@extends('layouts.app')

@section('title', 'Configuration')

@section('content_header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="h3 mb-0 text-gray-800">Configuration Setting</h1>
          <span>
            @if($other->status == 0)
                  <div class="center"><i class="fas fa-hourglass-half"></i> Waiting for approval...</div>
                @endif
          </span>
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
      <form method="post" action="{{ (Auth::user()->email == $approvalUser->email && $other->status == 0) ? route('configuration.update.approval') :route('configuration.update.status') }}" id="configForm">
        @csrf
        <input type="hidden" name="id" value="{{$other->id}}" id="rowId"/>
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
                  <div class="card-header">
                    System configuration
                  </div>
                  <div class="card-body">
                    <table class="table table-hover table-striped">
                      <tbody>
                        <tr>
                          <input type="hidden" name="sms_otp" value="0">
                          <td>SMS OTP </td>
                          <td><input type="checkbox"  data-id="" name="sms_otp"  class="js-switch" {{$other->sms_otp == "on" ? 'checked' : ''}}  ></td>
                        </tr>
                        <tr>
                          <input type="hidden" name="email_otp" value="0">
                          <td>Email OTP </td>
                          <td><input type="checkbox" data-id="" name="email_otp" class="js-switch" {{$other->email_otp == "on" ? 'checked' : ''}}  ></td>
                        </tr>
                        <tr>
                          <input type="hidden" name="auditlog_eap" value="0">
                          <td>Audit Log EAP</td>
                          <td><input type="checkbox" data-id="" name="auditlog_eap" class="js-switch" {{$other->auditlog_eap == "on" ? 'checked' : ''}}></td>
                        </tr>
                        <tr>
                          <input type="hidden" name="auditlog_bnpl" value="0">
                          <td>Audit Log BNPL</td>
                          <td><input type="checkbox" data-id="" name="auditlog_bnpl" class="js-switch" {{$other->auditlog_bnpl == "on" ? 'checked' : ''}}></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>

                <div class="card card-info">
                  <div class="card-header">
                    User configuration
                  </div>
                  <div class="card-body">
                    <table class="table table-hover table-striped">
                      <tbody>
                        <tr>
                          <td>Department</td>
                          <td><textarea class="form-control" rows="2" name="department">{{$other->department}}</textarea></td>
                        </tr>
                        <tr>
                          <td>Center</td>
                          <td><textarea class="form-control" rows="2" name="center">{{$other->center}}</textarea></td>
                        </tr>
                        <tr>
                          <td>Division</td>
                          <td><textarea class="form-control" rows="2" name="division">{{$other->division}}</textarea></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>

                <div class="card card-info">
                  <div class="card-header">
                    Approval configuration
                  </div>
                  <div class="card-body">
                    @php
                      use App\Models\User;
                      $users = User::All();
                      // print_r($users);
                    @endphp
                    <table class="table table-hover table-striped">
                      <tbody>
                        <tr>
                          <td>Approval Account</td>
                          <td>
                            <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" name="approval_acc">
                              <option data-select2-id="" value="">Select a option</option>
                              @foreach($users as $user)
                              <option data-select2-id="{{$user->id}}" value="{{$user->id}}" @if($user->id == $other->approval_acc) selected @endif>{{$user->email}}</option>
                              @endforeach
                              </select>
                        </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="card-footer" >
                
                <!-- /.card-body -->
                @if($other->status != 0)
                {{-- <button type="submit" name="submit" class="btn btn-success btn-user btn-block" style="width:20%; display:block; margin: 0 auto;">
                  Save
                </button> --}}
                <input type="hidden" name="appproval_email" value="{{$approvalUser->email}}"/>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                  <div data-toggle="modal" data-target="#confirmModal" style="width:20%; margin:0 auto;" class="btn btn-success btn-user btn-block" onClick="btnSubmit(this.value)">Save</div>
                  <div class="modal" id="confirmModal">
                    <div class="modal-dialog">
                      <div class="modal-content">
                      <!-- Modal Header -->
                      <div class="modal-header">
                        <h4 class="modal-title">Do you want to submit? </h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>
                      <!-- Modal footer -->
                      <div class="modal-footer">
                        <input type="hidden" name="approved" value="approved"/>
                        <button type="submit" name="approval" class="btn btn-danger">Yes</button>
                        <button type="button" class="btn" data-dismiss="modal">No</button>
                      </div>
                      </div>
                  </div>
                  </div>
                </div>
                @else
                  @if(Auth::user()->email == $approvalUser->email)
                  <div class="row">
                    <div class="col-md-6">
                      <div data-toggle="modal" data-target="#confirmModal1" class="btn btn-info btn-user btn-block float-right" style="width:20%;" onClick="btnSubmit(this.value)">Approval</div>
                        <div class="modal" id="confirmModal1">
                          <div class="modal-dialog">
                            <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                              <h4 class="modal-title">Do you want to approved? </h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <!-- Modal footer -->
                            <div class="modal-footer">
                              <input type="hidden" name="approved" value="approved"/>
                              <button type="submit" name="approval" class="btn btn-danger">Yes</button>
                              <button type="button" class="btn" data-dismiss="modal">No</button>
                            </div>
                            </div>
                        </div>
                      </div>
                      {{-- <input type="hidden" name="approved" value="approved"/>
                      <button type="submit" name="approval" class="btn btn-info btn-user btn-block float-right" style="width:20%;">
                        Approval
                      </button> --}}
                    </div>
                    <div class="col-md-6">
                      <div data-toggle="modal" data-target="#confirmModal2" class="btn btn-danger btn-user btn-block" style="width:20%;" onClick="btnSubmit(this.value)">Reject</div>
                        <div class="modal" id="confirmModal2">
                          <div class="modal-dialog">
                            <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                              <h4 class="modal-title">Do you want to reject? </h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <!-- Modal footer -->
                            <div class="modal-footer">
                              <button type="button" name="reject" class="btn btn-danger">Yes</button>
                              <button type="button" class="btn" data-dismiss="modal">No</button>
                            </div>
                            </div>
                        </div>
                      </div>
                      {{-- <button type="button" name="reject" class="btn btn-danger btn-user btn-block" style="width:20%;">
                        Reject
                      </button> --}}
                    </div>
                  </div>
                  @else
                  <div class="center" style="text-align: center;">Waiting for {{$approvalUser->email}} approval...</div>
                  @endif
                @endif
              </div>
              </form>
                </div>
                <!-- /.card-footer -->
            </div>
            
            <!-- /.card -->
          </div>
            
      <!-- /.timeline -->
<div style="height: 30px;"></div>
    </section>
        </div>
<!-- /.card -->
    </div>
@endsection




<style>

</style>

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

  $("[name='sms_otp']").bootstrapSwitch('offColor','warning');

  $('.js-switch').change(function () {
        status = $(this).prop('checked') === true ? 1 : 0;
        configId = $(this).data('id');
    });
});

$(function () {
    $('form#configForm').on('submit', function (e){
  });

  $('button[name=reject]').on('click',function(e){
    var id = $('#rowId').val();
    $.ajax({
            type: "POST",
            dataType: "json",
            url: '{{ route('configuration.update.reject') }}',
            data: {
              'id': id ,
              "_token": "{{ csrf_token() }}"
            },
            success: function (data) {
              location.reload();
            }
        });
  });
});

let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

elems.forEach(function(html) {
    let switchery = new Switchery(html,  { size: 'small' });
});


let formChanged = false;
	  var myForms = document.querySelectorAll('.card-body input')
    var myTexts = document.querySelectorAll('.card-body textarea')
	  var mySelects = document.querySelectorAll('.card-body select')
	  for (let myForm of myForms) 
	  {
	  	myForm.addEventListener('change', function() {formChanged = true});
		window.addEventListener('beforeunload', (event) => {
		if (formChanged) {
			event.returnValue = 'You have unfinished changes!';
		}
		});
	}
	for (let mySelect of mySelects) 
	  {
		mySelect.addEventListener('change', function() {formChanged = true});
		window.addEventListener('beforeunload', (event) => {
		if (formChanged) {
			event.returnValue = 'You have unfinished changes!';
		}
		});
  }
  
  for (let Text of myTexts) 
	  {
    Text.addEventListener('change', function() {formChanged = true});
		window.addEventListener('beforeunload', (event) => {
		if (formChanged) {
			event.returnValue = 'You have unfinished changes!';
		}
		});
  }


</script>

@stop