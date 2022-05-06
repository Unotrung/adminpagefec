@extends('layouts.app')
@section('title', 'Users')
@section('css')

@section('content')
<div class="container-fluid">
    
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h2 class="h3 mb-0 text-gray-800">Add User</h2>
            <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="{{ route('users') }}"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
        </div>

{{-- @if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif --}}

<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary"></h6> </div>
	<div class="card-body">
		<form method="post" action="{{route('users.store')}}"> 
			@csrf
			<div class="form-group row"> 
				{{-- Name field --}}
				<div class="input-group mb-3">
					<input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
						   value="{{ old('name') }}" placeholder="{{ __('adminlte::adminlte.full_name') }}" autofocus>
		
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
						</div>
					</div>
		
					@error('name')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
				{{-- Email field --}}
				<div class="input-group mb-3">
					<input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
						value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}">

					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
						</div>
					</div>

					@error('email')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>

				{{-- Password field --}}
				<div class="input-group mb-3">
					<input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
						placeholder="{{ __('adminlte::adminlte.password') }}">

					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
						</div>
					</div>

					@error('password')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>

				{{-- Confirm password field --}}
				<div class="input-group mb-3">
					<input type="password" name="password_confirmation"
						class="form-control @error('password_confirmation') is-invalid @enderror"
						placeholder="{{ __('adminlte::adminlte.retype_password') }}">

					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
						</div>
					</div>

					@error('password_confirmation')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>

				<div class="input-group mb-3">
					<select id="department" class="form-control" name="department">
						<option value="" selected="">Select Department</option>																			
						<option value="IT">IT</option>
						<option value="Accountant">Accountant</option>
						<option value="Business">Business</option>
					</select>
				</div>

				<div class="input-group mb-3">
					<select id="center" class="form-control" name="center">
						<option value="" selected="">Select Center</option>																			
						<option value="IT">IT</option>
						<option value="Accountant">Accountant</option>
						<option value="Business">Business</option>
					</select>
				</div>

				<div class="input-group mb-3">
					<select id="division" class="form-control" name="division">
						<option value="" selected="">Select Division</option>																			
						<option value="IT">IT</option>
						<option value="Accountant">Accountant</option>
						<option value="Business">Business</option>
					</select>
				</div>

				<div class="input-group mb-3">
					<select class="form-control form-control-user @error('role') is-invalid @enderror" name="role">
						<option selected disabled>Select Role</option>
						@foreach ($roles as $role)
							<option value="{{$role->name}}">{{$role->name}}</option>
						@endforeach
					</select> 
					
					@error('name') 
					<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror 
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 text-center">
				<div data-toggle="modal" data-target="#demoModal" class="btn btn-success btn-user btn-block">
					Submit
				</div>
				<div class="modal" id="demoModal">
					<div class="modal-dialog">
						<div class="modal-content">
						<!-- Modal Header -->
						<div class="modal-header">
							<h4 class="modal-title">Do you want to add a new user?  </h4>
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

@endsection