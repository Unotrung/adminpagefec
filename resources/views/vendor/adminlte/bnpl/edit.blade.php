<!-- caredit.blade.php  -->
<!--  -->
@extends('layouts.app')
@section('title', 'BNPL')
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

    <div class="col-sm-5">
                    <h1 class="m-0">BNPL Infomation</h1>
                    <!-- <small class="text-muted"><cite title="Source Title">BNPL listing</cite></small> -->
                    
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
        <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#bnpl_info" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">BNPL Infomation</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="custom-content-below-messages-tab" data-toggle="pill" href="#timeline" role="tab" aria-controls="custom-content-below-messages" aria-selected="false">Timeline</a>
      </li>
    </ul>
    <div class="tab-content" id="custom-content-below-tabContent">
      <div class="tab-pane fade active show " id="bnpl_info" role="tabpanel" aria-labelledby="custom-content-below-profile-tab" style="overflow:auto; height:400px;">
      @if(!empty($bnpl))  
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label">Name</label>
          <div class="col-sm-10">
          <div class="col-md-10 fvalue">{{$bnpl["name"]}}</div>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label">Phone</label>
          <div class="col-sm-10">
          <div class="col-md-10 fvalue">{{$bnpl["phone"]}}</div>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label">CitizenID</label>
          <div class="col-sm-10">
          <div class="col-md-10 fvalue">{{$bnpl["citizenId"]}}</div>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label">Sex</label>
          <div class="col-sm-10">
          <div class="col-md-10 fvalue">{{$bnpl["sex"]}}</div>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label">Date of Birth</label>
          <div class="col-sm-10">
            
          <div class="col-md-10 fvalue">{{date('d-m-Y', strtotime($bnpl["birthday"]))}}</div>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label">Issuedate</label>
          <div class="col-sm-10">
            
          <div class="col-md-10 fvalue">{{date('d-m-Y', strtotime($bnpl["issueDate"]))}}</div>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label">City</label>
          <div class="col-sm-10">
          <div class="col-md-10 fvalue">{{$bnpl["city"]}}</div>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label">District</label>
          <div class="col-sm-10">
          <div class="col-md-10 fvalue">{{$bnpl["district"]}}</div>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label">Ward</label>
          <div class="col-sm-10">
          <div class="col-md-10 fvalue">{{$bnpl["ward"]}}</div>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label">Street</label>
          <div class="col-sm-10">
          <div class="col-md-10 fvalue">{{$bnpl["street"]}}</div>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label">Personal Title Ref</label>
          <div class="col-sm-10">
          <div class="col-md-10 fvalue">{{$bnpl["personal_title_ref"]}}</div>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label">Name Ref</label>
          <div class="col-sm-10">
          <div class="col-md-10 fvalue">{{$bnpl["name_ref"]}}</div>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label">Phone Ref</label>
          <div class="col-sm-10">
          <div class="col-md-10 fvalue">{{$bnpl["phone_ref"]}}</div>
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
                  <span class="bg-red">10 Feb. 2014</span>
                </div>
        
                <div>
                  <i class="fas fa-envelope bg-blue"></i>
                    <div class="timeline-item">
                      <span class="time"><i class="fas fa-clock"></i> 12:05</span>
                      <h3 class="timeline-header"><a href="#">{{$bnpl["name"]}}</a> sent you an email</h3>
                      <div class="timeline-body">
                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                        weebly ning heekya handango imeem plugg dopplr jibjab, movity
                        jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                        quora plaxo ideeli hulu weebly balihoo...
                      </div>
                      <div class="timeline-footer">
                        <a class="btn btn-primary btn-sm">Read more</a>
                        <a class="btn btn-danger btn-sm">Delete</a>
                      </div>
                    </div>
                </div>
        
        
                <div>
                  <i class="fas fa-user bg-green"></i>
                    <div class="timeline-item">
                      <span class="time"><i class="fas fa-clock"></i> 5 mins ago</span>
                      <h3 class="timeline-header no-border"><a href="#">{{$bnpl["name"]}}</a> accepted your friend request</h3>
                    </div>
                </div>
        
        
                <div>
                  <i class="fas fa-comments bg-yellow"></i>
                    <div class="timeline-item">
                      <span class="time"><i class="fas fa-clock"></i> 27 mins ago</span>
                      <h3 class="timeline-header"><a href="#">{{$bnpl["name"]}}</a> commented on your post</h3>
                      <div class="timeline-body">
                        Take me to your leader!
                        Switzerland is small and neutral!
                        We are more like Germany, ambitious and misunderstood!
                      </div>
                      <div class="timeline-footer">
                        <a class="btn btn-warning btn-sm">View comment</a>
                      </div>
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