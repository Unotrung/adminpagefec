<link rel="stylesheet"
href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@extends('layouts.app')
@section('title', 'Users')
@section('css')
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="../../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

  <!-- Toastr -->
  <link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
  <link href="toastr.css" rel="stylesheet"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" 
     href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<style>
   #admin {
      display: none;
   }
</style>
@section('content_header')
<div class="container-fluid">
<div class="row mb-2">
<div class="col-sm-11">
            <h2 class="h3 mb-0 text-gray-800">Edit User </h2>
			<small class="text-muted"><cite title="Source Title">Edit Users's Details and User's Role </cite></small>
</div>
<div class="col-sm-1">
            <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="{{ route('users') }}"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
        </div>
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
		<ul class="nav nav-tabs" id='myTab'>
		  <li><a class="nav-link active" href="#activity" data-toggle="tab" id="user_tab">User</a></li>
		  <li><a class="nav-link" href="#settings" data-toggle="tab" id="role_tab">Role</a></li>
		</ul>
	  </div><!-- /.card-header -->
	  <div class="card-body">
		<div class="tab-content">
		  <div class=" tab-pane active" id="activity">
			<div class="card shadow mb-4">
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
							<div class="col-sm-6 mb-3 mb-sm-0"> <span style="color:red;">*</span>Division: </label>
								<select id="user" class="form-control" name="division">
									<option value="" selected="">{{$user->division}}</option>																			
									@foreach (explode(';',$configdiv) as $configsdiv)		
									@if($configsdiv!=$user->division)																	 --}}
										<option value="{{$configsdiv}}">{{$configsdiv}}</option>
									@endif
						@endforeach
								</select>
							</span>  </div> 
							<div class="col-sm-6 mb-3 mb-sm-0"> <span style="color:red;">*</span>Center: </label>
								<select id="user" class="form-control" name="center">
									<option value="" selected="">{{$user->center}}</option>																		
									@foreach (explode(';',$configcen) as $configscen)		
									@if($configscen != $user->center)									
										<option value="{{$configscen}}">{{$configscen}}</option>
									@endif
									@endforeach
								</select>
							</span>  </div> {{-- Confirm Password --}}
							<div class="col-sm-6 mb-3 mb-sm-0"> <span style="color:red;">*</span>Department: </label>
								<select id="user" class="form-control" name="department">
									<option value="" selected="">{{$user->department}}</option>
									@foreach (explode(';',$configdep) as $configsdep)		
									@if($configsdep!=$user->department)																	 --}}
									<option value="{{$configsdep}}">{{$configsdep}}</option>
									@endif
									@endforeach
								</select>
							</span>  </div> 
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
							<div data-toggle="modal" data-target="#confirmModal" class="btn btn-success btn-user btn-block" onClick="btnSubmit(this.value)">Update </div>
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
			<form method="POST" action="{{route('user.assignrole')}}">
				@csrf
				<input type="hidden" name="id" value="{{$user->id}}">
			  <table>
				@foreach ($roles as $role)
					@if ($role->is_delete != 1)
					<tr>
						<td>
							
							<input type="radio" value="{{$role->name}}" @if($user->hasRole($role->name)) checked @endif name="role" id="role-{{$role->id}}"/> 
							<label for="role-{{$role->id}}">{{$role->name}}</label>
							
						</td>
					</tr>
					@endif
				@endforeach
			  </table>
			  <div data-toggle="modal" data-target="#demoModal" class="btn btn-success btn-user btn-block" style="width:20%; display:block; margin: 0 auto;">
				Submit
			</div>

			<div class="modal" id="demoModal">
				<div class="modal-dialog">
					<div class="modal-content">
					<!-- Modal Header -->
						<div class="modal-header">
							<h4 class="modal-title">Do you want to add a new role?  </h4>
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
			</form>
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
	</script>
@endsection
@section('js')
<script>
	$('#myTab a').click(function(e) {
  	e.preventDefault();
  	$(this).tab('show');
	});

	// store the currently selected tab in the hash value
	$("ul.nav-tabs > li > a").on("shown.bs.tab", function(e) {
	var id = $(e.target).attr("href").substr(1);
	window.location.hash = id;
	});

	// on load of the page: switch to the currently selected tab
	var hash = window.location.hash;
	$('#myTab a[href="' + hash + '"]').tab('show');
	// $(function(){
	// 	var url = window.location.href;
	// 	var activeTab;
	// 	if(url.indexOf("#") == -1){
	// 		activeTab = "activity";
	// 	}else{
	// 		activeTab = url.substring(url.indexOf("#") + 1);
	// 	}

	// 	$('a[href="#'+ activeTab +'"]').removeClass("active");
	// 	$("#" + activeTab).removeClass("active");
	// 	$("#" + activeTab).addClass("active");
	// 	$('a[href="#'+ activeTab +'"]').tab('show');
	// });


	// $(document).ready(function() {
	// 	$(document).on('click', 'li', function(e) {
	// 		e.preventDefault();
	// 		$(this).closest("ul").find("li").removeClass("active");
	// 		$(this).addClass("active");
	// 	});
	// });
	// $('#user_tab').click(function(){
	// 	var url = window.location.href;
	// 	var urls = url.split('#')[0];
	// 	console.log(urls);
	// 	var activeTab = "activity"
	// 	window.open(urls+"#"+activeTab);
	// });

</script>
<!-- SweetAlert2 -->
<script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="../../plugins/toastr/toastr.min.js"></script>
<script src="toastr.js"></script>

@stop