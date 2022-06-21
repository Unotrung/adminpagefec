<!-- caredit.blade.php  -->
<!--  -->
@extends('layouts.app')
@section('title', 'FAQs')
@section('content_header')
<div class="container-fluid">
  <div class="row mb-2">
    {{-- <div class="col-sm-5">
      
    </div> --}}
    <div class="col-sm-12">
      <h1 class="m-0">FAQ Details
        <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm float-right" href="{{ route('faqs.index') }}"><i
            class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a></h1>
    </div>
  </div>
</div>
@stop
@section('css')


  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">

@stop
@section('content')

@php
$config = [
    "cancelButtonClasses" => "btn-danger",
];
@endphp


<div class="card card-primary card-outline">
  <div class="card-body">
    <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="custom-content-below-profile-tab" data-toggle="pill" href="#bnpl_info" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">FAQ Information</a>
      </li> 
    </ul>
    <div class="tab-content" id="custom-content-below-tabContent">
      <div class="tab-pane fade active show " id="bnpl_info" role="tabpanel" aria-labelledby="custom-content-below-profile-tab" style="">
      
      <div class="row">
        <div class="card-body">
          {{-- <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-10">
            <div class="col-md-10 fvalue">{{$faqs->Title}}</div>
            </div>
          </div> --}}

          <div class="row" style="padding-top:2%">
            {{-- <div class="col-sm-10"> --}}
            <label for="inputPassword3" class="col-sm-2">Title:</label><div class ="col-sm-10" style="">{{$faqs->Title}}</div>
          {{-- </div> --}}
        </div>

          <div class="row" style="padding-top:2%">
              {{-- <div class="col-sm-10"> --}}
              <label for="inputPassword3" class="col-sm-2">Description:</label><div class ="col-sm-10" style="">{{$faqs->Description}}</div>
            {{-- </div> --}}
          </div>

          <div class="row"  style="padding-top:2%">
            {{-- <div class="col-sm-10"> --}}
            <label for="inputPassword3" class="col-sm-2">Content:</label><div class ="col-sm-10" style="">{!!$faqs->Content!!}</div>
          {{-- </div> --}}
        </div>

          {{-- <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-10">
            <div class="col-md-10 fvalue">{{$faqs->Description}}</div>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-10">
            <div class="col-md-10 fvalue">{!!$faqs->Content!!}</div>
            </div>
          </div> --}}
          
        </div>
      </div>
    </div>
   
    
    </div>
  </div>
  
</div>




{{-- Minimal --}}
@stop 
