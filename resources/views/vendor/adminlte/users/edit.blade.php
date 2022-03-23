<link rel="stylesheet"
href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@extends('layouts.app')
@section('title', 'Users')
@section('css')

@php
use App\Models\User;
$old = User::find($user);
$roles = App\Models\Role::all();
$permissions = App\Models\Permission::all();
$old_role = App\Models\Role::find($old['role_ids'][0]);
@endphp
<style>
   #admin {
      display: none;
   }
</style>
@section('content_header')
<div class="container-fluid">
    
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h2 class="h3 mb-0 text-gray-800">Edit User </h2>
            <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="{{ route('users.index') }}"><i
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

<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">Add New User</h6> </div>
	<div class="card-body">
		<form method="POST" action="{{route('users.update', 'id='.$user)}}"> @csrf
			<div class="form-group row"> {{-- Name --}}
				<div class="col-sm-6 mb-3 mb-sm-0"> <span style="color:red;">*</span>Name: </label>
					<input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="exampleName" placeholder="Name" name="name" value="{{ $old['name'] }}"> @error('name') <span class="text-danger">{{$message}}</span> @enderror </div> {{-- Email --}}
				<div class="col-sm-6 mb-3 mb-sm-0"> <span style="color:red;">*</span>Email: </label>
					<input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="exampleEmail" placeholder="Email" name="email" value="{{ $old['email'] }}"> @error('name') <span class="text-danger">{{$message}}</span> @enderror </div> {{-- Password --}}
				<div class="col-sm-6 mb-3 mb-sm-0"> <span style="color:red;">*</span>Phone: </label>
					<input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="examplePassword" placeholder="Phone number" name="phone" value="{{ $old['phone'] }}"> @error('name') <span class="text-danger">{{$message}}</span> @enderror </div> {{-- Confirm Password --}}
				<div class="col-sm-6 mb-3 mb-sm-0"> <span style="color:red;">*</span>Password: </label>
					<input type="password" class="form-control form-control-user @error('name') is-invalid @enderror" id="exampleConfirmPassword" placeholder="Password" name="confirm_password" value="{{ $old['password'] }}"> @error('name') <span class="text-danger">{{$message}}</span> @enderror </div> {{-- Role --}}
				<div class="col-sm-6 mb-3 mb-sm-0"> <span style="color:red;">*</span>Role: </label>
				<select onchange="displayDivDemo('admin', this)" class="form-control form-control-user" name="role">
						@foreach ($roles as $role)
								<option value="{{$old_role['name'] ?: 'default value' }}" selected>{{$role['name']}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div id="admin">
				<h6><b>Admin's Permissions Set Up</b></h6>
				<form action="#">
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
				</form>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 text-center">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
			<script>
   				function displayDivDemo(id, elementValue) {  
					var role = elementValue.value;
					console.log(id);
					if(role == 'admin' && id == 'admin' ){
						document.getElementById(id).style.display = 'block';
					}
					else
					{
						document.getElementById(id).style.display = 'block';
					}
   				   //document.getElementById(id).style.display = elementValue.value == 'admin' ? 'block' : 'none';

   				}
			</script>
		</form>
	</div>
</div>
</div>
@endsection