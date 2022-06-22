<!-- caredit.blade.php  -->
<!--  -->
@extends('layouts.app')
@section('title', 'Statics')
@section('content_header')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="pull-left">
            <h2>Statics Details</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('statics.index') }}"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i>Back</a>
        </div>
    </div>
</div>
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
        <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="" role="tab" aria-controls="custom-content-below-home" aria-selected="false">General Information</a>
      </li>
    </ul>
    <div class="tab-content" id="custom-content-below-tabContent">
      <div class="tab-pane fade active show " id="eap_info" role="tabpanel" aria-labelledby="custom-content-below-home-tab" >
          <div class="card-body">
            <div class="form-group row">

              <div class="col-sm-12">
                <div class="col-md-10 fvalue"><label for="inputPassword3" class="col-sm-2 col-form-label">Title:</label>{{$statics->Title}}</div>
              </div>

              <div class="col-sm-12">
                <div class="col-md-10 fvalue"><label for="inputPassword3" class="col-sm-2 col-form-label" >Content:</label>{{$statics->Content}}
                </div>
              </div>

              <div class="col-sm-12">
                <div class="col-md-10 fvalue"><label for="inputPassword3" class="col-sm-2 col-form-label">Description:</label>{{$statics->Description}}
                </div>
              </div>
              <div class="col-sm-12">
                <div class="col-md-10 fvalue"><label for="inputPassword3" class="col-sm-2 col-form-label">URL:</label>{{$statics->Title}}
                </div>
              </div>
              <div class="col-sm-12">
                <div class="col-md-10 fvalue"><label for="inputPassword3" class="col-sm-2 col-form-label">Image:</label><img class="col-md-6 fvalue" src="{{ asset("./ImagesStatics/$statics->Image") }} " alt="">
                </div>
              </div>
              <div class="col-sm-12">
                <div class="col-md-10 fvalue"><label for="inputPassword3" class="col-sm-2 col-form-label">Author:</label> {{$statics->Author}}
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>

</div>




{{-- Minimal --}}
@stop
