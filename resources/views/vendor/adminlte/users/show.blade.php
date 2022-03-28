@extends('layouts.app')
@section('title', 'Users')
@section('css')

<style>
    img  {
  float: left;
}
    </style>
@section('content_header')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4"> 
        <div class="pull-left">
            <h2> </h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('users') }}"> Back</a>
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
            <div class="col-md-4">
                    <table class="table table-bordered table-striped" id="user">
                        <tbody>
                            <tr>
                                <td>Name:</td>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <td>Email:</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <td>Role:</td>
                                <tr>
                                    @if(!empty($user->getRoleNames()))
                                    @foreach($user->getRoleNames() as $v)
                                    <td>{{ $v }}</td>
                                    @endforeach
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection