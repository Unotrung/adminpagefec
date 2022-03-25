@extends('layouts.app')
@section('title', 'FAQs')
@section('css')

@section('content')
<div class="container-fluid">
    
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h2 class="h3 mb-0 text-gray-800">Create FAQs</h2>
            <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="{{ route('faqs.index') }}"><i
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
		<h6 class="m-0 font-weight-bold text-primary">Add New FAQs</h6> </div>
	<div class="card-body">
		<form method="POST" action="{{route('faqs.store')}}"> @csrf
			<div class="form-group row"> {{-- Question --}}
				<div class="col-sm-6 mb-3 mb-sm-0"> <span style="color:red;">*</span>Question: </label>
					<input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="question" placeholder="" name="question" value=""> @error('name') <span class="text-danger">{{$message}}</span> @enderror </div> {{-- Answer --}}
				<div class="col-sm-6 mb-3 mb-sm-0"> <span style="color:red;">*</span>Answer: </label>
					<input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="answer" placeholder="" name="answer" value=""> @error('name') <span class="text-danger">{{$message}}</span> @enderror </div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 text-center">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div>
</div>
</div>

@endsection