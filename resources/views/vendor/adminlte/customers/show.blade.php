<!-- caredit.blade.php  -->
<!--  -->
@extends('layouts.app')
@section('title', 'Customer')
@section('content_header')
    <!-- Content Header (Page header) -->
    <!-- <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">BNPL Edit</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item "><a href="#">BNPL</a></li>
              <li class="breadcrumb-item active">Edit</li>
            </ol>
          </div>
        </div>
      </div>
    </div> -->



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
      @if($eap_check == 1 && $bnpl_check == 1) 
      <li class="nav-item">
      <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true">EAP Infomation</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">BNPL Infomation</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="custom-content-below-messages-tab" data-toggle="pill" href="#custom-content-below-messages" role="tab" aria-controls="custom-content-below-messages" aria-selected="false">Timeline</a>
      </li>
    @elseif($eap_check == 1 && empty($bnpl_check)) 
    <li class="nav-item">
    <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true">EAP Infomation</a>
    </li>
    {{-- <li class="nav-item">
    <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">BNPL Infomation</a>
    </li> --}}
    <li class="nav-item">
      <a class="nav-link" id="custom-content-below-messages-tab" data-toggle="pill" href="#custom-content-below-messages" role="tab" aria-controls="custom-content-below-messages" aria-selected="false">Timeline</a>
    </li>
    @elseif($bnpl_check == 1 && empty($_check)) 
    <li class="nav-item">
    <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="true">BNPL Infomation</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="custom-content-below-messages-tab" data-toggle="pill" href="#custom-content-below-messages" role="tab" aria-controls="custom-content-below-messages" aria-selected="false">Timeline</a>
    </li>
    @endif
    
    {{-- active show --}}
    {{-- <li class="nav-item">
    <a class="nav-link" id="custom-content-below-settings-tab" data-toggle="pill" href="#custom-content-below-settings" role="tab" aria-controls="custom-content-below-settings" aria-selected="false">Settings</a>
    </li> --}}
    </ul>
    <div class="tab-content" id="custom-content-below-tabContent">
      @if($eap_check == 1 && $bnpl_check == 1)
      <div class="tab-pane fade active show " id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
      @elseif ($eap_check == 1 && empty($bnpl_check))
      <div class="tab-pane fade active show" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
      @elseif ($bnpl_check == 1 && empty($eap_check))
      <div class="tab-pane fade" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
      @endif
      <div class="card-body">
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
          <div class="col-sm-10">
          <div class="col-md-10 fvalue">{{$cus["username"]}}</div>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label">Email</label>
          <div class="col-sm-10">
          <div class="col-md-10 fvalue">{{$cus["email"]}}</div>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword4" class="col-sm-2 col-form-label">Phone</label>
          <div class="col-sm-10">
            <div class="col-md-10 fvalue">{{$cus["phone"]}}</div>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword4" class="col-sm-2 col-form-label">Resent OTP</label>
           <div class="col-sm-10">
           <button type="button" style="width: 100px;" class=" btn btn-block bg-gradient-success">Send OTP</button>
           </div>
        </div>
      </div>
    </div>
      @if($bnpl_check == 1 && $eap_check == 1 )
      <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab" style="overflow:scroll; height:400px;">
      @elseif($bnpl_check == 1 && empty($eap_check))
      <div class="tab-pane fade active show" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab" style="overflow:scroll; height:400px;">
      @elseif ($eap_check == 1 && empty($bnpl_check))
      <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab" style="overflow:scroll; height:400px;">
      @endif
      @if(!empty($bnpl_info))  
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label">Name</label>
          <div class="col-sm-10">
          <div class="col-md-10 fvalue">{{$bnpl_info["name"]}}</div>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label">Phone</label>
          <div class="col-sm-10">
          <div class="col-md-10 fvalue">{{$bnpl_info["phone"]}}</div>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label">CitizenID</label>
          <div class="col-sm-10">
          <div class="col-md-10 fvalue">{{$bnpl_info["citizenId"]}}</div>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label">Sex</label>
          <div class="col-sm-10">
          <div class="col-md-10 fvalue">{{$bnpl_info["sex"]}}</div>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label">Date of Birth</label>
          <div class="col-sm-10">
          <div class="col-md-10 fvalue">{{$bnpl_info["birthday"]}}</div>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label">Issuedate</label>
          <div class="col-sm-10">
          <div class="col-md-10 fvalue">{{$bnpl_info["issueDate"]}}</div>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label">City</label>
          <div class="col-sm-10">
          <div class="col-md-10 fvalue">{{$bnpl_info["city"]}}</div>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label">District</label>
          <div class="col-sm-10">
          <div class="col-md-10 fvalue">{{$bnpl_info["district"]}}</div>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label">Ward</label>
          <div class="col-sm-10">
          <div class="col-md-10 fvalue">{{$bnpl_info["ward"]}}</div>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label">Street</label>
          <div class="col-sm-10">
          <div class="col-md-10 fvalue">{{$bnpl_info["street"]}}</div>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label">Personal Title Ref</label>
          <div class="col-sm-10">
          <div class="col-md-10 fvalue">{{$bnpl_info["personal_title_ref"]}}</div>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label">Name Ref</label>
          <div class="col-sm-10">
          <div class="col-md-10 fvalue">{{$bnpl_info["name_ref"]}}</div>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label">Phone Ref</label>
          <div class="col-sm-10">
          <div class="col-md-10 fvalue">{{$bnpl_info["phone_ref"]}}</div>
          </div>
        </div>
        @endif
    </div>
    <div class="tab-pane fade" id="custom-content-below-messages" role="tabpanel" aria-labelledby="custom-content-below-messages-tab">
    Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna.
    </div>
    <div class="tab-pane fade" id="custom-content-below-settings" role="tabpanel" aria-labelledby="custom-content-below-settings-tab">
    Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
    </div>
    </div>
  </div>
  
</div>




{{-- Minimal --}}
@stop 
<script>
  
</script>
