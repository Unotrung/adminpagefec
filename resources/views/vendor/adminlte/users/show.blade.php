@extends('layouts.app')
@section('title', 'Users')
@section('css')

<style>
    img  {
  float: left;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" 
   href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<!-- Theme style -->
<link rel="stylesheet" href="../../dist/css/adminlte.min.css">
@stop
@section('content_header')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4"> 
        <div class="pull-left">
            <h2>User Profile</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('users') }}"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i>  Back</a>
        </div>
    </div>
</div>
@stop

@section('content')
<section class="content">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <ul class="nav nav-pills">
                <li class="nav-item">
                <h6 class="m-0 font-weight-bold text-primary">User Profile</h6>
            </li>
        </div>
        <div class="card-body">
            <p>
            <div class="col-md-6">
                    <table class="table table-bordered table-striped" id="user">
                        <tbody>
                            <tr>
                                <td>Full name:</td>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <td>Email:</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <td>Role:</td>
                                    @if(!empty($user->getRoleNames()))
                                    <td>
                                        @foreach($user->getRoleNames() as $v)
                                        {{ $v }}</br>
                                        @endforeach
                                    </td>
                                    @endif
                            </tr>
                            <tr>
                                <td>Division:</td>
                                <td>{{ $user->division }}</td>
                            </tr>
                            <tr>
                                <td>Center:</td>
                                <td>{{ $user->center }}</td>
                            </tr>
                            <tr>
                                <td>Department:</td>
                                <td>{{ $user->department }}</td>
                            </tr>
                            </tbody>
                        </table>
                </div>
                </div>
            </div>
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
</section>
@endsection