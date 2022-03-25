<link rel="stylesheet"
href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@extends('layouts.app')
@section('title', 'Users')
@section('css')

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
		<form method="POST" action="{{route('users.update', 'id='.$user->id)}}"> @csrf
			<div class="form-group row"> {{-- Name --}}
				<div class="col-sm-6 mb-3 mb-sm-0"> <span style="color:red;">*</span>Name: </label>
					<input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="exampleName" placeholder="Name" name="name" value="{{ $user['name'] }}"> @error('name') <span class="text-danger">{{$message}}</span> @enderror </div> {{-- Email --}}
				<div class="col-sm-6 mb-3 mb-sm-0"> <span style="color:red;">*</span>Email: </label>
					<input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="exampleEmail" placeholder="Email" name="email" value="{{ $user['email'] }}"> @error('name') <span class="text-danger">{{$message}}</span> @enderror </div> {{-- Password --}}
				<div class="col-sm-6 mb-3 mb-sm-0"> <span style="color:red;">*</span>Phone: </label>
					<input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="examplePassword" placeholder="Phone number" name="phone" value="{{ $user['phone'] }}"> @error('name') <span class="text-danger">{{$message}}</span> @enderror </div> {{-- Confirm Password --}}
				<div class="col-sm-6 mb-3 mb-sm-0"> <span style="color:red;">*</span>Password: </label>
					<input type="password" class="form-control form-control-user @error('name') is-invalid @enderror" id="exampleConfirmPassword" placeholder="Password" name="confirm_password" value="{{ $user['password'] }}"> @error('name') <span class="text-danger">{{$message}}</span> @enderror </div> {{-- Role --}}
				<div class="col-sm-6 mb-3 mb-sm-0"> <span style="color:red;">*</span>Role: </label>
				<select onchange="displayDivDemo('admin', this)" class="form-control form-control-user" name="role">
						@foreach ($roles as $role)
								<option value="" selected>{{$role['name']}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 text-center">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div>
</div>
</div>
@endsection