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
      @if(($eap_check == 1 && $bnpl_check == 1)) 
      @if(!empty($cus))
      <li class="nav-item">
      <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#eap_info" role="tab" aria-controls="custom-content-below-home" aria-selected="true">EAP Infomation</a>
      </li>
      @else
      <li class="nav-item">
        <a class="nav-link" id="custom-content-below-home-tab" data-toggle="pill" href="#eap_info" role="tab" aria-controls="custom-content-below-home" aria-selected="true">EAP Infomation</a>  
      </li>
      @endif
      @if(empty($cus) && !empty($bnpl_info))
      <li class="nav-item">
        <a class="nav-link active" id="custom-content-below-profile-tab" data-toggle="pill" href="#bnpl_info" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">BNPL Infomation</a>
      </li>
      @else
      <li class="nav-item">
        <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#bnpl_info" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">BNPL Infomation</a>
      </li>
      @endif
      <li class="nav-item">
        <a class="nav-link" id="custom-content-below-messages-tab" data-toggle="pill" href="#timeline" role="tab" aria-controls="custom-content-below-messages" aria-selected="false">Timeline</a>
      </li>
    @elseif(($eap_check == 1 && empty($bnpl_check))) 
    <li class="nav-item">
    <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#eap_info" role="tab" aria-controls="custom-content-below-home" aria-selected="true">EAP Infomation</a>
    </li>
    {{-- <li class="nav-item">
    <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">BNPL Infomation</a>
    </li> --}}
    <li class="nav-item">
      <a class="nav-link" id="custom-content-below-messages-tab" data-toggle="pill" href="#timeline" role="tab" aria-controls="custom-content-below-messages" aria-selected="false">Timeline</a>
    </li>
    @elseif(($bnpl_check == 1 && empty($_check)) ) 
    <li class="nav-item">
    <a class="nav-link " id="custom-content-below-profile-tab" data-toggle="pill" href="#bnpl_info" role="tab" aria-controls="custom-content-below-profile" aria-selected="true">BNPL Infomation</a>
    </li>
    {{-- <li class="nav-item">
      <a class="nav-link" id="custom-content-below-messages-tab" data-toggle="pill" href="#timeline" role="tab" aria-controls="custom-content-below-messages" aria-selected="false">Timeline</a>
    </li> --}}
    @endif
    
    {{-- active show --}}
    {{-- <li class="nav-item">
    <a class="nav-link" id="custom-content-below-settings-tab" data-toggle="pill" href="#custom-content-below-settings" role="tab" aria-controls="custom-content-below-settings" aria-selected="false">Settings</a>
    </li> --}}
    </ul>
    <div class="tab-content" id="custom-content-below-tabContent">
      @if($eap_check == 1 && $bnpl_check == 1 && !empty($cus))
      <div class="tab-pane fade active show " id="eap_info" role="tabpanel" aria-labelledby="custom-content-below-home-tab" >
      @elseif($eap_check == 1 && $bnpl_check == 1 && empty($cus))
      <div class="tab-pane fade" id="eap_info" role="tabpanel" aria-labelledby="custom-content-below-home-tab" >  
      @elseif ($eap_check == 1 && empty($bnpl_check) && !empty($cus))
      <div class="tab-pane fade active show" id="eap_info" role="tabpanel" aria-labelledby="custom-content-below-home-tab" >
      @elseif ($eap_check == 1 && empty($bnpl_check) && empty($cus))
      <div class="tab-pane fade" id="eap_info" role="tabpanel" aria-labelledby="custom-content-below-home-tab" >
      @elseif ($bnpl_check == 1 && empty($eap_check) && empty($cus))
      <div class="tab-pane fade " id="eap_info" role="tabpanel" aria-labelledby="custom-content-below-home-tab" >
      @endif
        @if(!empty($cus))
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
        @endif
      </div>
      @if($bnpl_check == 1 && $eap_check == 1 && (empty($bnpl_info)))
      <div class="tab-pane fade" id="bnpl_info" role="tabpanel" aria-labelledby="custom-content-below-profile-tab" style="min-height: 600px">
      @elseif($bnpl_check == 1 && $eap_check == 1 && (!empty($bnpl_info) && empty($cus)))
      <div class="tab-pane fade active show" id="bnpl_info" role="tabpanel" aria-labelledby="custom-content-below-profile-tab" style="min-height: 600px">
      @elseif($bnpl_check == 1 && empty($eap_check))
      <div class="tab-pane fade active show" id="bnpl_info" role="tabpanel" aria-labelledby="custom-content-below-profile-tab" style="min-height: 600px">
      @elseif ($eap_check == 1 && empty($bnpl_check))
      <div class="tab-pane fade" id="bnpl_info" role="tabpanel" aria-labelledby="custom-content-below-profile-tab" style="min-height: 600px">
      @endif
      @if(!empty($bnpl_info))  
      <div class="row">
        <div class="col-6">
          <label for="inputPassword3" class="col-sm-4 col-form-label">Personal Infomation</label>
          <div class="card" style="background-color: #A9A9A9">
            <div class="col-sm-8">
              <div class="col-md-10 fvalue"><label for="inputPassword3" class="col-sm-4 col-form-label">Name:</label>{{$bnpl_info["name"]}}</div>
            </div>
          
            
            <div class="col-sm-8">
              <div class="col-md-10 fvalue"><label for="inputPassword3" class="col-sm-4 col-form-label">Phone:</label>{{$bnpl_info["phone"]}}</div>
            </div>

            <div class="col-sm-8">
              <div class="col-md-10 fvalue"><label for="inputPassword3" class="col-sm-4 col-form-label">FICO:</label>50.000.000đ</div>
            </div>
          </div>
          <label for="inputPassword3" class="col-sm-4 col-form-label">Provider</label>
          <div class="card" style="background-color: #A9A9A9">

          </div>
        </div>
        <div class="col-6" style="">
          <label for="inputPassword3" class="col-sm-4 col-form-label">Another Information</label>
          <div class="card" style="background-color: #A9A9A9">
            
            <div class="col-sm-12">
              <div class="col-md-10 fvalue"><label for="inputPassword3" class="col-sm-7 col-form-label">CitizenID:</label>{{$bnpl_info["citizenId"]}}</div>
            </div>

            
            <div class="col-sm-12">
              <div class="col-sm-10 fvalue"><label for="inputPassword3" class="col-sm-7 col-form-label">Date of Birth:</label>{{date('d-m-Y', strtotime($bnpl_info["birthday"]))}}</div>
            </div>
          
            
            <div class="col-sm-12">
              <div class="col-sm-10 fvalue"><label for="inputPassword3" class="col-sm-7 col-form-label">Issuedate:</label>{{date('d-m-Y', strtotime($bnpl_info["issueDate"]))}}</div>
            </div>

            
            <div class="col-sm-12">
              <div class="col-md-10 fvalue"><label for="inputPassword3" class="col-sm-7 col-form-label">City:</label>{{$bnpl_info["city"]}}</div>
            </div>
        
            
            <div class="col-sm-12">
              <div class="col-md-10 fvalue"><label for="inputPassword3" class="col-sm-7 col-form-label">District:</label>{{$bnpl_info["district"]}}</div>
            </div>
        
            
            <div class="col-sm-12">
              <div class="col-md-10 fvalue"><label for="inputPassword3" class="col-sm-7 col-form-label">Ward:</label>{{$bnpl_info["ward"]}}</div>
            </div>
        
            
            <div class="col-sm-12">
              <div class="col-md-10 fvalue"><label for="inputPassword3" class="col-sm-7 col-form-label">Street:</label>{{$bnpl_info["street"]}}</div>
            </div>
        
            
            <div class="col-sm-12">
              <div class="col-md-10 fvalue"><label for="inputPassword3" class="col-sm-7 col-form-label">Personal Title Ref:</label>{{$bnpl_info["personal_title_ref"]}}</div>
            </div>
        
           
            <div class="col-sm-12">
              <div class="col-md-10 fvalue"> <label for="inputPassword3" class="col-sm-7 col-form-label">Name Ref:</label>{{$bnpl_info["name_ref"]}}</div>
            </div>

            
            <div class="col-sm-12">
              <div class="col-md-10 fvalue"><label for="inputPassword3" class="col-sm-7 col-form-label">Phone Ref:</label>{{$bnpl_info["phone_ref"]}}</div>
            </div>
          </div>
        </div>
      </div>
      @endif
    </div>
    <div class="tab-pane fade" id="timeline" role="tabpanel" aria-labelledby="custom-content-below-messages-tab" >
      <section class="content" style="overflow:auto; height:400px;">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              @if(!empty($cus))
              <div class="timeline">
                <div class="time-label">
                  <span class="bg-red">{{date('d-m-Y', strtotime($cus["updatedAt"]))}}</span>
                </div>
        
             
                <div>
                  <i class="fas fa-sign-out-alt bg-red"></i>
                    <div class="timeline-item">
                      <span class="time"><i class="fas fa-clock"></i> 27 mins ago</span>
                      <h3 class="timeline-header"><a href="#">{{$cus["username"]}}</a> Has Logout </h3>
                    </div>
                </div>
        
        
                <div>
                  <i class="fas fa-sign-in-alt bg-green"></i>
                    <div class="timeline-item">
                      <span class="time"><i class="fas fa-clock"></i> 12:05</span>
                      <h3 class="timeline-header"><a href="#">{{$cus["username"]}}</a> Has login</h3>
                    </div>
                </div>
        
                <div class="time-label">
                  <span class="bg-yellow">28-04-2022</span>
                </div>

                <div>
                  <i class="fas fa-edit"></i>
                    <div class="timeline-item">
                      <span class="time"><i class="fas fa-clock"></i>17:05</span>
                      <h3 class="timeline-header"><a href="#">{{$cus["username"]}}</a> is change Information</h3>
                    </div>
                </div>


                <div class="time-label">
                  <span class="bg-green">27-04-2022</span>
                </div>

                <div>
                  <i class="fas fa-lock"></i>
                    <div class="timeline-item">
                      <span class="time"><i class="fas fa-clock"></i>13:45</span>
                      <h3 class="timeline-header"><a href="#">{{$cus["username"]}}</a> is change password</h3>
                    </div>
                </div>



                <div>
                <i class="fas fa-clock bg-gray"></i>
                </div>
              </div>
              @endif
            </div>
        
          </div>
        </div>
        
        </section>
    </div>
    <div class="tab-pane fade" id="custom-content-below-settings" role="tabpanel" aria-labelledby="custom-content-below-settings-tab">
    Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
    </div>
    </div>
  </div>
  
</div>




{{-- Minimal --}}
@stop 
@section('js')
<script>
$('#custom-content-below-tab a').click(function(e) {
  	e.preventDefault();
  	$(this).tab('show');
	});

	// store the currently selected tab in the hash value
	$("ul.nav-tabs > li > a").on("shown.bs.tab", function(e) {
	var id = $(e.target).attr("href").substr(1);
	window.location.hash = id;
	});

	// on load of the page: switch to the currently selected tab
	var hash = window.location.hash;
	$('#myTab a[href="' + hash + '"]').tab('show');  
</script>
@stop