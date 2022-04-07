<link rel="stylesheet"
href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@extends('layouts.app')
@section('title', 'Users')
@section('css')
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="../../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
<style>
   #admin {
      display: none;
   }
</style>
@section('content_header')
<div class="container-fluid">
    
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h2 class="h3 mb-0 text-gray-800">Edit User </h2>
            <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="{{ route('users') }}"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
        </div>
@stop

@section('content')
@if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif



<!-- /.col -->
<div class="col-md-12">
	<div class="card">
	  <div class="card-header p-2">
		<ul class="nav nav-pills">
		  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">User</a></li>
		  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Role</a></li>
		</ul>
	  </div><!-- /.card-header -->
	  <div class="card-body">
		<div class="tab-content">
		  <div class="active tab-pane" id="activity">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">
						
					</h6> </div>
				<div class="card-body">
					<form method="POST" action="{{route('users.update')}}"> 
						@csrf
						<input type="hidden" name="id" value="{{$user->id}}">
						<div class="form-group row"> {{-- Name --}}
							<div class="col-sm-6 mb-3 mb-sm-0"> <span style="color:red;">*</span>Name: </label>
								<input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="exampleName" placeholder="Name" name="name" value="{{$user->name}}">@error('name') <span class="text-danger"></span> @enderror </div> {{-- Email --}}
							<div class="col-sm-6 mb-3 mb-sm-0"> <span style="color:red;">*</span>Email: </label>
								<input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="exampleEmail" placeholder="Email" name="email" value="{{$user->email}}"> @error('name') <span class="text-danger"></span> @enderror </div> {{-- Password --}}
							<div class="col-sm-6 mb-3 mb-sm-0"> <span style="color:red;">*</span>Phone: </label>
								<input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="examplePassword" placeholder="Phone number" name="phone" value="{{$user->phone}}"> @error('name') <span class="text-danger"></span> @enderror </div> {{-- Confirm Password --}}
						</div>
						<div id="admin">
							<h6><b>Admin's Permissions Set Up</b></h6>
								@foreach ($permissions as $permission)
									   @if (Str::contains($permission['name'],'customer') == true)
									   <h6><b>Module Customers</b></h6>
										<input type="checkbox" id="permission" name="permission" value="{{ $permission['name'] }}">
										<label> {{$permission['name']}}</label><br>
									@elseif (Str::contains($permission['name'],'notification') == true)
									<h6><b>Module Notification</b></h6>
										<input type="checkbox" id="permission" name="permission" value="{{ $permission['name'] }}">
										<label> {{$permission['name']}}</label><br>
									@endif
								@endforeach
			
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12 text-center">
							<div data-toggle="modal" data-target="#demoModal" class="btn btn-success btn-user btn-block" onClick="btnSubmit(this.value)">Update </div>
							<div class="modal" id="demoModal">
								<div class="modal-dialog">
									<div class="modal-content">
									<!-- Modal Header -->
									<div class="modal-header">
										<h4 class="modal-title">Do you want to submit? </h4>
										<button type="button" class="close" data-dismiss="modal">&times;</button>
									</div>
									<!-- Modal footer -->
									<div class="modal-footer">
										<button type="submit" class="btn btn-danger">Yes</button>
										<button type="button" class="btn" data-dismiss="modal">No</button>
									</div>
									</div>
							</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		  </div>
		 
		  <!-- /.tab-pane -->

		  <div class="tab-pane" id="settings">
			  <table>
				@foreach ($roles as $role)
					<tr>
						<td>
							<input type="checkbox" value="{{$role->name}}" @if($user->hasRole($role->name)) checked @endif onClick="btnRole(this.checked,this.value)"/> {{$role->name}}
						</td>
					</tr>
				@endforeach
			  </table>
		  </div>
		  <!-- /.tab-pane -->
		</div>
		<!-- /.tab-content -->
	  </div><!-- /.card-body -->
	</div>
	<!-- /.card -->
  </div>
  <!-- /.col -->
</div>
@endsection
@section('js')
<!-- SweetAlert2 -->
<script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="../../plugins/toastr/toastr.min.js"></script>
<script>
	var Toast = Swal.mixin({
		toast: true,
		position: 'top-end',
		showConfirmButton: false,
		timer: 3000
		});
	function btnRole(e,d){
		console.log(d);
		if(e){
			$.ajax({
				url : "{{route('user.assignrole')}}",
				type: "POST",
				data : {
					_token: "{{ csrf_token() }}",
					id : "{{ $user->id }}",
					role : d
				}
			}).done(function(msg){
				Toast.fire({
					icon: 'success',
					title: "Update Successful"
				});
			}).fail(function(msg){
				Toast.fire({
					icon: 'error',
					title: "Update Fail"
				});
			});
		}else{
			$.ajax({
				url : "{{route('user.removerole')}}",
				type: "POST",
				data : {
					_token: "{{ csrf_token() }}",
					id : "{{ $user->id }}",
					role : d
				}
			}).done(function(msg){
				Toast.fire({
					icon: 'success',
					title: "Update Successful"
				});
			}).fail(function(msg){
				Toast.fire({
					icon: 'error',
					title: "Update Fail"
				});
			});
		}
	};
	function btnSubmit(){
		$('.swalDefaultSuccess').click(function() {
      		Toast.fire({
        		icon: 'success',
        		title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      		})
    	});
	};
</script>
@stop