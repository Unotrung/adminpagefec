<!-- caredit.blade.php  -->
<!--  -->

@extends('layouts.app')

<style>
  .box-info{
    border: 1px solid #dee2e6;
    padding: 20px 25px;
  }
</style>

@section('title', 'Customer')
@section('content_header')

<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-12">
        <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm float-right" href="{{ route('customer') }}"><i
            class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
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
      @if(empty($cus) && !empty($bnpl_info))
      <li class="nav-item">
        <a class="nav-link" id="custom-content-below-home-tab" data-toggle="pill" href="#eap_info" role="tab" aria-controls="custom-content-below-home" aria-selected="true">EAP Information</a>
        </li>
      @else
      <li class="nav-item">
        <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#eap_info" role="tab" aria-controls="custom-content-below-home" aria-selected="true">EAP Information</a>
        </li>
      @endif
      @if(empty($cus) && !empty($bnpl_info))
      <li class="nav-item">
        <a class="nav-link active" id="custom-content-below-profile-tab" data-toggle="pill" href="#bnpl_info" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">BNPL Information</a>
      </li>
      @else
      <li class="nav-item">
        <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#bnpl_info" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">BNPL Information</a>
      </li>
      @endif
        
        <li class="nav-item">
          <a class="nav-link" id="custom-content-below-messages-tab" data-toggle="pill" href="#timeline" role="tab" aria-controls="custom-content-below-messages" aria-selected="false">Timeline</a>
        </li>
    {{-- @if(($eap_check == 1 && $bnpl_check == 1)) 
      @if(!empty($cus) && !empty($bnpl_info))
        <li class="nav-item">
        <a class="nav-link " id="custom-content-below-home-tab" data-toggle="pill" href="#eap_info" role="tab" aria-controls="custom-content-below-home" aria-selected="true">EAP Infomation</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#bnpl_info" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">BNPL Infomation</a>
        </li>
        @elseif (!empty($cus) && empty($bnpl_info))
        <li class="nav-item">
          <a class="nav-link " id="custom-content-below-home-tab" data-toggle="pill" href="#eap_info" role="tab" aria-controls="custom-content-below-home" aria-selected="true">EAP Infomation</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#bnpl_info" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">BNPL Infomation</a>
          </li>
        @elseif (empty($cus) && !empty($bnpl_info))
        <li class="nav-item">
          <a class="nav-link" id="custom-content-below-home-tab" data-toggle="pill" href="#eap_info" role="tab" aria-controls="custom-content-below-home" aria-selected="true">EAP Infomation</a>  
        </li>
        <li class="nav-item">
          <a class="nav-link " id="custom-content-below-profile-tab" data-toggle="pill" href="#bnpl_info" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">BNPL Infomation</a>
        </li>
      @endif
      <li class="nav-item">
        <a class="nav-link" id="custom-content-below-messages-tab" data-toggle="pill" href="#timeline" role="tab" aria-controls="custom-content-below-messages" aria-selected="false">Timeline</a>
      </li>
    @elseif(($eap_check == 1 && empty($bnpl_check))) 
      <li class="nav-item">
      <a class="nav-link " id="custom-content-below-home-tab" data-toggle="pill" href="#eap_info" role="tab" aria-controls="custom-content-below-home" aria-selected="true">EAP Infomation</a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" id="custom-content-below-messages-tab" data-toggle="pill" href="#timeline" role="tab" aria-controls="custom-content-below-messages" aria-selected="false">Timeline</a>
      </li>
    @elseif(($bnpl_check == 1 && empty($_check)) ) 
      <li class="nav-item">
      <a class="nav-link " id="custom-content-below-profile-tab" data-toggle="pill" href="#bnpl_info" role="tab" aria-controls="custom-content-below-profile" aria-selected="true">BNPL Infomation</a>
      </li>
      
    @endif
     --}}
    {{-- active show --}}
    {{-- <li class="nav-item">
    <a class="nav-link" id="custom-content-below-settings-tab" data-toggle="pill" href="#custom-content-below-settings" role="tab" aria-controls="custom-content-below-settings" aria-selected="false">Settings</a>
    </li> --}}
    </ul>
    <div class="tab-content" id="custom-content-below-tabContent">
      @if(empty($cus) && !empty($bnpl_info))
      <div class="tab-pane fade" id="eap_info" role="tabpanel" aria-labelledby="custom-content-below-home-tab" >
      @else
      <div class="tab-pane fade active show " id="eap_info" role="tabpanel" aria-labelledby="custom-content-below-home-tab" >
      @endif
        {{-- $eap_check == 1 && $bnpl_check == 1 --}}
    {{-- @if(($eap_check == 1 && $bnpl_check == 1) && (!empty($cus) && !empty($bnpl_inffo)))
        <div class="tab-pane fade  " id="eap_info" role="tabpanel" aria-labelledby="custom-content-below-home-tab" >
        @elseif(($eap_check == 1 && $bnpl_check == 1) && (empty($cus) && !empty($bnpl_inffo)))
        <div class="tab-pane fade" id="eap_info" role="tabpanel" aria-labelledby="custom-content-below-home-tab" >  
        @elseif(($eap_check == 1 && $bnpl_check == 1) && (!empty($cus) && empty($bnpl_inffo)))
        <div class="tab-pane fade " id="eap_info" role="tabpanel" aria-labelledby="custom-content-below-home-tab" >   --}}
        

          {{-- $eap_check == 1 && empty($bnpl_check) --}}
        {{-- @elseif (($eap_check == 1 && empty($bnpl_check)) && (!empty($cus) && !empty($bnpl_inffo)))
        <div class="tab-pane fade " id="eap_info" role="tabpanel" aria-labelledby="custom-content-below-home-tab" >
        @elseif (($eap_check == 1 && empty($bnpl_check)) && (empty($cus) && !empty($bnpl_inffo)))
        <div class="tab-pane fade" id="eap_info" role="tabpanel" aria-labelledby="custom-content-below-home-tab" >
        @elseif (($eap_check == 1 && empty($bnpl_check)) && (!empty($cus) && empty($bnpl_inffo)))
        <div class="tab-pane fade " id="eap_info" role="tabpanel" aria-labelledby="custom-content-below-home-tab" >
          --}}

          {{-- $bnpl_check == 1 && empty($eap_check) --}}
        {{-- @elseif (($bnpl_check == 1 && empty($eap_check)) && (!empty($cus) && !empty($bnpl_inffo)))
        <div class="tab-pane fade " id="eap_info" role="tabpanel" aria-labelledby="custom-content-below-home-tab" >
        @elseif (($bnpl_check == 1 && empty($eap_check)) && (empty($cus) && !empty($bnpl_inffo)))
        <div class="tab-pane fade " id="eap_info" role="tabpanel" aria-labelledby="custom-content-below-home-tab" >
        @elseif (($bnpl_check == 1 && empty($eap_check)) && (!empty($cus) && empty($bnpl_inffo)))
        <div class="tab-pane fade " id="eap_info" role="tabpanel" aria-labelledby="custom-content-below-home-tab" > --}}
     
    {{-- @endif --}}
        @if(!empty($cus))
          <div class="card-body">
            <div class="form-group row">
              
              <div class="col-sm-8">
                <div class="col-md-10 fvalue"><label for="inputPassword3" class="col-sm-2 col-form-label">Name:</label>{{$cus["username"]}}</div>
              </div>

              {{-- <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
              <div class="col-sm-10">
              <div class="col-md-10 fvalue">{{$cus["username"]}}</div>
              </div> --}}
              <div class="col-sm-8">
                <div class="col-md-10 fvalue"><label for="inputPassword3" class="col-sm-2 col-form-label">Email:</label>{{$cus["email"]}}<i class="fas fa-check-circle" style="padding-left: 30px; color:green !important;" ></i></div>
              </div>
              
              <div class="col-sm-8">
                <div class="col-md-10 fvalue"><label for="inputPassword3" class="col-sm-2 col-form-label">Phone:</label>{{$cus["phone"]}}<i class="icon fas fa-exclamation-triangle" style="padding-left: 30px;color:red !important;"></i></div>
              </div>

              {{-- <div class="col-sm-8">
                <div class="col-md-10 fvalue"><label for="inputPassword3" class="col-sm-4 col-form-label">Resent OTP:</label><button type="button" style="width: 100px;" class=" btn btn-block bg-gradient-success">Send OTP</button></div>
              </div> --}}
            
              {{-- <label for="inputPassword3" class="col-sm-2 col-form-label">Email</label>
              <div class="col-sm-10">
              <div class="col-md-10 fvalue">{{$cus["email"]}}</div>
              </div>
            
              <label for="inputPassword4" class="col-sm-2 col-form-label">Phone</label>
              <div class="col-sm-10">
                <div class="col-md-10 fvalue">{{$cus["phone"]}}</div>
              </div> --}}
            
              {{-- <label for="inputPassword4" class="col-sm-2 col-form-label">Resent OTP</label>
              <div class="col-sm-10">
              <button type="button" style="width: 100px;" class=" btn btn-block bg-gradient-success">Send OTP</button>
              </div> --}}
            </div>
          </div>
          @else
          <div class="card" style="text-align: center;padding: 70px 0" >
            {{-- <div class="d-flex flex-column min-vh-100 justify-content-center align-items-center"> --}}
              <p><i class="fa fa-info-circle" aria-hidden="true"></i>User has not registered to EAP.</p>
            {{-- </div> --}}
          </div>
        @endif
      </div>
      @if(empty($cus) && !empty($bnpl_info))
      <div class="tab-pane fade active show" id="bnpl_info" role="tabpanel" aria-labelledby="custom-content-below-profile-tab" style="min-height: 400px">
      @else
      <div class="tab-pane fade" id="bnpl_info" role="tabpanel" aria-labelledby="custom-content-below-profile-tab" style="min-height: 400px">
      @endif
      
      {{-- $bnpl_check == 1 && $eap_check == 1 --}}
        {{-- @if(($bnpl_check == 1 && $eap_check == 1) && (!empty($cus) && !empty($bnpl_inffo)))
          <div class="tab-pane fade" id="bnpl_info" role="tabpanel" aria-labelledby="custom-content-below-profile-tab" style="min-height: 600px">
          @elseif(($bnpl_check == 1 && $eap_check == 1) && (!empty($bnpl_info) && empty($cus)))
          <div class="tab-pane fade " id="bnpl_info" role="tabpanel" aria-labelledby="custom-content-below-profile-tab" style="min-height: 600px">
            @elseif(($bnpl_check == 1 && $eap_check == 1) && (empty($bnpl_info) && !empty($cus)))
          <div class="tab-pane fade" id="bnpl_info" role="tabpanel" aria-labelledby="custom-content-below-profile-tab" style="min-height: 600px"> --}}
          
          
          {{-- $bnpl_check == 1 && empty($eap_check) --}}
          {{-- @elseif(($bnpl_check == 1 && empty($eap_check)) && (!empty($cus) && !empty($bnpl_inffo)))
          <div class="tab-pane fade " id="bnpl_info" role="tabpanel" aria-labelledby="custom-content-below-profile-tab" style="min-height: 600px">
          @elseif(($bnpl_check == 1 && empty($eap_check)) && (empty($cus) && !empty($bnpl_inffo)))
          <div class="tab-pane fade " id="bnpl_info" role="tabpanel" aria-labelledby="custom-content-below-profile-tab" style="min-height: 600px">
          @elseif(($bnpl_check == 1 && empty($eap_check)) && (!empty($cus) && empty($bnpl_inffo)))
          <div class="tab-pane fade" id="bnpl_info" role="tabpanel" aria-labelledby="custom-content-below-profile-tab" style="min-height: 600px"> --}}
          

          {{-- $eap_check == 1 && empty($bnpl_check) --}}  
          {{-- @elseif (($eap_check == 1 && empty($bnpl_check)) && (!empty($cus) && !empty($bnpl_inffo)))
          <div class="tab-pane fade" id="bnpl_info" role="tabpanel" aria-labelledby="custom-content-below-profile-tab" style="min-height: 600px">
          @elseif (($eap_check == 1 && empty($bnpl_check)) && (empty($cus) && !empty($bnpl_inffo)))
          <div class="tab-pane fade" id="bnpl_info" role="tabpanel" aria-labelledby="custom-content-below-profile-tab" style="min-height: 600px">
          @elseif (($eap_check == 1 && empty($bnpl_check)) && (!empty($cus) && empty($bnpl_inffo)))
          <div class="tab-pane fade" id="bnpl_info" role="tabpanel" aria-labelledby="custom-content-below-profile-tab" style="min-height: 600px">
        @endif --}}




        @if(!empty($bnpl_info))  
        <div class="row">
          <div class="col-6">
            <label for="inputPassword3" class="col-sm-4 col-form-label">Personal Information</label>
            <div class="card box-info">
              <div class="col-sm-8">
                <div class="col-md-12 fvalue"><label for="inputPassword3" class="col-sm-4 col-form-label">Name:</label>{{$bnpl_info["name"]}}</div>
              </div>
            
              
              <div class="col-sm-8">
                <div class="col-md-12 fvalue"><label for="inputPassword3" class="col-sm-4 col-form-label">Phone:</label>{{$bnpl_info["phone"]}}</div>
              </div>

              <div class="col-sm-8">
                <div class="col-md-12 fvalue"><label for="inputPassword3" class="col-sm-6 col-form-label">Credit Limit:</label>50,000,000 VND</div>
              </div>
            </div>
            <label for="inputPassword3" class="col-sm-4 col-form-label">Provider</label>
            <div class="card box-info" style="text-align: center;padding: 74px 0" >
              {{-- <div class="d-flex flex-column min-vh-100 justify-content-center align-items-center"> --}}
                <p><i class="fa fa-info-circle" aria-hidden="true"></i>To be updated</p>
              {{-- </div> --}}
            </div>
          </div>
          <div class="col-6" style="">
            <label for="inputPassword3" class="col-sm-4 col-form-label">Other Information</label>
            <div class="card box-info" >
              
              <div class="col-sm-12">
                <div class="col-md-10 fvalue"><label for="inputPassword3" class="col-sm-7 col-form-label">NID:</label>{{$bnpl_info["citizenId"]}}</div>
              </div>

              
              <div class="col-sm-12">
                <div class="col-sm-10 fvalue"><label for="inputPassword3" class="col-sm-7 col-form-label">Date of Birth:</label>{{date('d/m/Y', strtotime($bnpl_info["birthday"]))}}</div>
              </div>
            
              
              <div class="col-sm-12">
                <div class="col-sm-10 fvalue"><label for="inputPassword3" class="col-sm-7 col-form-label">Issued Date:</label>{{date('d/m/Y', strtotime($bnpl_info["issueDate"]))}}</div>
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
                <div class="col-md-10 fvalue"><label for="inputPassword3" class="col-sm-7 col-form-label">Reference Relationship:</label>{{$bnpl_info["personal_title_ref"]}}</div>
              </div>
          
            
              <div class="col-sm-12">
                <div class="col-md-10 fvalue"> <label for="inputPassword3" class="col-sm-7 col-form-label">Reference Name:</label>{{$bnpl_info["name_ref"]}}</div>
              </div>

              
              <div class="col-sm-12">
                <div class="col-md-10 fvalue"><label for="inputPassword3" class="col-sm-7 col-form-label">Reference Phone:</label>{{$bnpl_info["phone_ref"]}}</div>
              </div>
            </div>
          </div>
        </div>
        @else
        <div class="card" style="text-align: center;padding: 70px 0" >
          {{-- <div class="d-flex flex-column min-vh-100 justify-content-center align-items-center"> --}}
            <p><i class="fa fa-info-circle" aria-hidden="true"></i>User has not registered to BNPL.</p>
          {{-- </div> --}}
        </div>
        @endif
      </div>
      <div class="tab-pane fade" id="timeline" role="tabpanel" aria-labelledby="custom-content-below-messages-tab" >
        <section class="content" style="margin-top:30px">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                @if(!empty($cus))
                <div class="timeline">
                  <div class="time-label">
                    <span class="bg-red">{{date('d/m/Y', strtotime($cus["updatedAt"]))}}</span>
                  </div>
          
              
                  <div>
                    <i class="fas fa-sign-out-alt bg-red"></i>
                      <div class="timeline-item">
                        <span class="time"><i class="fas fa-clock"></i> 27 mins ago</span>
                        <h3 class="timeline-header"><a href="#">{{$cus["username"]}}</a> logged out. </h3>
                      </div>
                  </div>
          
          
                  <div>
                    <i class="fas fa-sign-in-alt bg-green"></i>
                      <div class="timeline-item">
                        <span class="time"><i class="fas fa-clock"></i> 12:05</span>
                        <h3 class="timeline-header"><a href="#">{{$cus["username"]}}</a> logged in.</h3>
                      </div>
                  </div>
          
                  <div class="time-label">
                    <span class="bg-yellow">28/04/2022</span>
                  </div>

                  <div>
                    <i class="fas fa-sign-out-alt bg-red"></i>
                      <div class="timeline-item">
                        <span class="time"><i class="fas fa-clock"></i> 17:30</span>
                        <h3 class="timeline-header"><a href="#">{{$cus["username"]}}</a> logged out. </h3>
                      </div>
                  </div>

                  <div>
                    <i class="fas fa-edit"></i>
                      <div class="timeline-item">
                        <span class="time"><i class="fas fa-clock"></i>17:05</span>
                        <h3 class="timeline-header"><a href="#">{{$cus["username"]}}</a>changed Information.</h3>
                      </div>
                  </div>

                  <div>
                    <i class="fas fa-sign-in-alt bg-green"></i>
                      <div class="timeline-item">
                        <span class="time"><i class="fas fa-clock"></i> 17:00</span>
                        <h3 class="timeline-header"><a href="#">{{$cus["username"]}}</a> logged in.</h3>
                      </div>
                  </div>

                  <div class="time-label">
                    <span class="bg-green">27/04/2022</span>
                  </div>

                  <div>
                    <i class="fas fa-sign-out-alt bg-red"></i>
                      <div class="timeline-item">
                        <span class="time"><i class="fas fa-clock"></i> 13:50</span>
                        <h3 class="timeline-header"><a href="#">{{$cus["username"]}}</a> logged out. </h3>
                      </div>
                  </div>

                  <div>
                    <i class="fas fa-lock"></i>
                      <div class="timeline-item">
                        <span class="time"><i class="fas fa-clock"></i>13:45</span>
                        <h3 class="timeline-header"><a href="#">{{$cus["username"]}}</a> changed Password.</h3>
                      </div>
                  </div>

                  <div>
                    <i class="fas fa-sign-in-alt bg-green"></i>
                      <div class="timeline-item">
                        <span class="time"><i class="fas fa-clock"></i> 13:30</span>
                        <h3 class="timeline-header"><a href="#">{{$cus["username"]}}</a> logged in.</h3>
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