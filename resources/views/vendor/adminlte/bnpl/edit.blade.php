<!-- caredit.blade.php  -->
<!--  -->
@extends('layouts.app')
@section('title', 'BNPL')
@section('content_header')
<div class="row mb-2">
  <div class="col-sm-12">
      <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm float-right" href="{{ route('bnpl') }}"><i
          class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
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
        <a class="nav-link active" id="custom-content-below-profile-tab" data-toggle="pill" href="#bnpl_info" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">BNPL Information</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="custom-content-below-messages-tab" data-toggle="pill" href="#timeline" role="tab" aria-controls="custom-content-below-messages" aria-selected="false">Timeline</a>
      </li>
    </ul>
    <div class="tab-content" id="custom-content-below-tabContent">
      <div class="tab-pane fade active show " id="bnpl_info" role="tabpanel" aria-labelledby="custom-content-below-profile-tab" style="">
      @if(!empty($bnpl))  
      <div class="row">
        <div class="col-6">
          <label for="inputPassword3" class="col-sm-4 col-form-label">Personal Information</label>
          <div class="card" style="background-color: #A9A9A9" >
            <div class="col-sm-8">
              <div class="col-md-10 fvalue"><label for="inputPassword3" class="col-sm-4 col-form-label">Name:</label>{{$bnpl["name"]}}</div>
            </div>
          
            
            <div class="col-sm-8">
              <div class="col-md-10 fvalue"><label for="inputPassword3" class="col-sm-4 col-form-label">Phone:</label>{{$bnpl["phone"]}}</div>
            </div>

            <div class="col-sm-8">
              <div class="col-md-10 fvalue"><label for="inputPassword3" class="col-sm-4 col-form-label">FICO:</label>50,000,000 VND</div>
            </div>
          </div>
          <label for="inputPassword3" class="col-sm-4 col-form-label">Provider</label>
          <div class="card" style="background-color: #A9A9A9;min-height: 212px;text-align: center;padding: 70px 0" >
            {{-- <div class="d-flex flex-column min-vh-100 justify-content-center align-items-center"> --}}
              <p><i class="fa fa-info-circle" aria-hidden="true"></i>To be updated</p>
            {{-- </div> --}}
          </div>
        </div>
        <div class="col-6" style="">
          <label for="inputPassword3" class="col-sm-4 col-form-label">Other Information</label>
          <div class="card" style="background-color: #A9A9A9">
            
            <div class="col-sm-12">
              <div class="col-md-10 fvalue"><label for="inputPassword3" class="col-sm-7 col-form-label">NID:</label>{{$bnpl["citizenId"]}}</div>
            </div>

            
            <div class="col-sm-12">
              <div class="col-sm-10 fvalue"><label for="inputPassword3" class="col-sm-7 col-form-label">Date of Birth:</label>{{date('d/m/Y', strtotime($bnpl["birthday"]))}}</div>
            </div>
          
            
            <div class="col-sm-12">
              <div class="col-sm-10 fvalue"><label for="inputPassword3" class="col-sm-7 col-form-label">Issued Date:</label>{{date('d/m/Y', strtotime($bnpl["issueDate"]))}}</div>
            </div>

            
            <div class="col-sm-12">
              <div class="col-md-10 fvalue"><label for="inputPassword3" class="col-sm-7 col-form-label">City:</label>{{$bnpl["city"]}}</div>
            </div>
        
            
            <div class="col-sm-12">
              <div class="col-md-10 fvalue"><label for="inputPassword3" class="col-sm-7 col-form-label">District:</label>{{$bnpl["district"]}}</div>
            </div>
        
            
            <div class="col-sm-12">
              <div class="col-md-10 fvalue"><label for="inputPassword3" class="col-sm-7 col-form-label">Ward:</label>{{$bnpl["ward"]}}</div>
            </div>
        
            
            <div class="col-sm-12">
              <div class="col-md-10 fvalue"><label for="inputPassword3" class="col-sm-7 col-form-label">Street:</label>{{$bnpl["street"]}}</div>
            </div>
        
            
            <div class="col-sm-12">
              <div class="col-md-10 fvalue"><label for="inputPassword3" class="col-sm-7 col-form-label">Reference Personal Title:</label>{{$bnpl["personal_title_ref"]}}</div>
            </div>
        
           
            <div class="col-sm-12">
              <div class="col-md-10 fvalue"> <label for="inputPassword3" class="col-sm-7 col-form-label">Reference Name:</label>{{$bnpl["name_ref"]}}</div>
            </div>

            
            <div class="col-sm-12">
              <div class="col-md-10 fvalue"><label for="inputPassword3" class="col-sm-7 col-form-label">Reference Phone:</label>{{$bnpl["phone_ref"]}}</div>
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
              @if(!empty($bnpl))
              <div class="timeline">
        
                <div class="time-label">
                  <span class="bg-yellow">23/04/2022</span>
                </div>


                <div>
                  <i class="fa fa-spinner"></i>
                    <div class="timeline-item">
                      <span class="time"><i class="fas fa-clock"></i> 13:15</span>
                      <h3 class="timeline-header no-border"><a href="#">{{$bnpl["name"]}}</a> User is waiting for e-KYC process.</h3>
                    </div>
                </div>

                <div>
                  <i class="fas fa-signature"></i>
                    <div class="timeline-item">
                      <span class="time"><i class="fas fa-clock"></i> 13:00</span>
                      <h3 class="timeline-header no-border"><a href="#">{{$bnpl["name"]}}</a> User is in e-KYC checking.</h3>
                    </div>
                </div>

                <div>
                  <i class="fa fa-registered bg-yellow"></i>
                    <div class="timeline-item">
                      <span class="time"><i class="fas fa-clock"></i> 12:45</span>
                      <h3 class="timeline-header no-border"><a href="#">{{$bnpl["name"]}}</a> User starts the registration process.</h3>
                    </div>
                </div>

                <div>
                  <i class="fa fa-plus bg-green"></i>
                    <div class="timeline-item">
                      <span class="time"><i class="fas fa-clock"></i> 12:40</span>
                      <h3 class="timeline-header no-border"><a href="#">{{$bnpl["name"]}}</a> User is created.</h3>
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
<!-- <x-adminlte-input name="name" type="text" placeholder="" label="Name" fgroup-class="col-md-6" disable-feedback value="{{ $bnpl["name"] }}"/> -->
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