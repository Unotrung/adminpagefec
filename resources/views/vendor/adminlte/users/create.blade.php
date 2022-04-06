@extends('layouts.app')
@section('title', 'Users')
@section('css')

@section('content')
<div class="container-fluid">
    
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h2 class="h3 mb-0 text-gray-800">Create New User</h2>
            <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="{{ route('users') }}"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
        </div>

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
		<form method="post" action="{{route('register')}}"> @csrf
			<div class="form-group row"> {{-- Name --}}
				<div class="col-sm-7 mb-3 mb-sm-0"> <span style="color:red;">*</span>Name: </label>
					<input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="exampleName" placeholder="Name" name="name" value="{{ old('name') }}"> @error('name') <span class="text-danger">{{$message}}</span> @enderror </div> {{-- Email --}}
				<div class="col-sm-7 mb-3 mb-sm-0"> <span style="color:red;">*</span>Email: </label>
					<input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="exampleEmail" placeholder="Email" name="email" value="{{ old('email') }}"> @error('name') <span class="text-danger">{{$message}}</span> @enderror </div> {{-- Password --}}
				<div class="col-sm-7 mb-3 mb-sm-0"> <span style="color:red;">*</span>Password: </label>
					<input type="password" class="form-control form-control-user @error('name') is-invalid @enderror" id="examplePassword" placeholder="Password" name="password" value="{{ old('password') }}"> @error('name') <span class="text-danger">{{$message}}</span> @enderror </div> {{-- Confirm Password --}}
				<div class="col-sm-7 mb-3 mb-sm-0"> <span style="color:red;">*</span>Confirm Password: </label>
					<input type="password" class="form-control form-control-user @error('name') is-invalid @enderror" id="exampleConfirmPassword" placeholder="Confirm Password" name="confirm_password" value="{{ old('password') }}"> @error('name') <span class="text-danger">{{$message}}</span> @enderror </div> {{-- Role --}}
				<div class="col-sm-7 mb-3 mb-sm-0"> <span style="color:red;">*</span>Role: </label>
					<select class="form-control form-control-user @error('guard_name') is-invalid @enderror" name="guard_name">
						<option selected disabled>Select Role</option>
						@foreach ($roles as $role)
							<option value="{{$role->name}}">{{$role->name}}</option>
						@endforeach
					</select> @error('name') <span class="text-danger">{{$message}}</span> @enderror </div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 text-center">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div>
</div>
</div>

@endsection