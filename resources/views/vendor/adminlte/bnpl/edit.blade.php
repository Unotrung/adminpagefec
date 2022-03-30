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



@stop

@section('content')

@php
$config = [
    "cancelButtonClasses" => "btn-danger",
];
@endphp


<div class="content">
        <div class="container-fluid">
            
    <!-- Main content -->
    <section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <ul class="nav nav-tabs" id="custom-content-above-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="custom-content-above-home-tab" data-toggle="pill" href="#custom-content-above-home" role="tab" aria-controls="custom-content-above-home" aria-selected="true">General Infomation</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-above-profile-tab" data-toggle="pill" href="#custom-content-above-profile" role="tab" aria-controls="custom-content-above-profile" aria-selected="false">Timeline</a>
              </li>
            </ul>
            <!-- <div class="tab-custom-content">
              <p class="lead mb-0">"Information BNPL"</p>
            </div> -->
            <div class="tab-content" id="custom-content-above-tabContent">
              <div class="tab-pane fade show active" id="custom-content-above-home" role="tabpanel" aria-labelledby="custom-content-above-home-tab">
                <form method="POST" action="/users/store">
                  <!-- Horizontal Form -->
            <div class="card card-info">
              <!-- <div class="card-header">
                <h3 class="card-title">Edit user</h3>
              </div> -->
              <!-- /.card-header -->
              <!-- form start -->
              <div class="card-body div-container" style="display: flex; flex-direction: row">
                  <div class="col-6">
                    
                    <div class="form-group row">
                      <label for="inputPassword3" class="col-sm-2 col-form-label">Phone Customer</label>
                      <div class="col-sm-10">
                      <div class="col-md-10 fvalue">{{$bnpl->phone}}</div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputPassword4" class="col-sm-2 col-form-label">Gender</label>
                      <div class="col-sm-10">
                        <div class="col-md-10 fvalue">{{$bnpl->sex}}</div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputPassword4" class="col-sm-2 col-form-label">Date of Birth</label>
                      <div class="col-sm-10">
                        <div class="col-md-10 fvalue" >{{$bnpl->birthday}}</div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputPassword4" class="col-sm-2 col-form-label">CitizenID</label>
                      <div class="col-sm-10">
                        <div class="col-md-10 fvalue">{{$bnpl->citizenId}}</div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputPassword4" class="col-sm-2 col-form-label">IssueDate</label>
                      <div class="col-sm-10">
                        <div class="col-md-10 fvalue">{{$bnpl->issueDate}}</div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputPassword4" class="col-sm-2 col-form-label">City</label>
                      <div class="col-sm-10">
                        <div class="col-md-10 fvalue">{{$bnpl->city}}</div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputPassword4" class="col-sm-2 col-form-label">District</label>
                      <div class="col-sm-10">
                        <div class="col-md-10 fvalue">{{$bnpl->district}}</div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputPassword4" class="col-sm-2 col-form-label">Ward</label>
                      <div class="col-sm-10">
                        <div class="col-md-10 fvalue">{{$bnpl->ward}}</div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputPassword4" class="col-sm-2 col-form-label">Street</label>
                      <div class="col-sm-10">
                        <div class="col-md-10 fvalue">{{$bnpl->street}}</div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputPassword4" class="col-sm-2 col-form-label">Danh xưng</label>
                      <div class="col-sm-10">
                        <div class="col-md-10 fvalue">{{$bnpl->personal_title_ref}}</div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputPassword4" class="col-sm-2 col-form-label">Tên người tham chiếu</label>
                      <div class="col-sm-10">
                        <div class="col-md-10 fvalue">{{$bnpl->name_ref}}</div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputPassword4" class="col-sm-2 col-form-label">Phone Number</label>
                      <div class="col-sm-10">
                        <div class="col-md-10 fvalue">{{$bnpl->phone_ref}}</div>
                      </div>
                    </div>
                  </div>
                 <div class="col-6">
                 <div class="form-group row">
                    <label for="inputPassword4" class="col-sm-12 col-form-label">Providers</label>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-12 dropdown">
                        @foreach ($bnpl_providers as $bnpl_pro)
                        @foreach ($bnpl_provider as $bnpl)
                        @if ($bnpl->id == $bnpl_pro)
                        <div class="col-md-10 fvalue">

                          <img  class="col-md-7" src="{{ asset("./ImagesProvider/$bnpl->Image") }}" alt="">
                          <label class="col-md-4 form-check-label" for="flexRadioDefault2">
                            {{$bnpl->provider}}
                            </label>
                        </div>
                        @endif
                        @endforeach
                        @endforeach
                        
                      </div>
                    </div>
                 </div>
                    
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                <a href="{{ URL::previous() }}" class="btn btn-primary">Back</a>
                  <!-- <button type="submit" class="btn btn-default">Cancel</button> -->
                  <!-- <button type="submit" class="btn btn-info float-right" >Sign in</button> -->
                  <!-- <li class=""><a href="http://127.0.0.1:8000/bnpl" data-toggle="tooltip" data-placement="right" title="Back to Customers"><i class="fa fa-chevron-left"></i>Cancel</a></li> -->
                </div>
                <!-- /.card-footer -->
            </div>
            <!-- /.card -->
                </form>
              </div>
              <div class="tab-pane fade" id="custom-content-above-profile" role="" aria-labelledby="custom-content-above-profile-tab">
                <form >
                     <!-- select -->
                <div class="form-group">
                  <!-- <label>Select Role</label> -->
                  <section class="content">
      <div class="container-fluid">

        <!-- Timelime example  -->
        <div class="row">
          <div class="col-md-12">
            <!-- The time line -->
            <div class="timeline">
              <!-- timeline time label -->
              <div class="time-label">
                <span class="bg-red">10 Feb. 2014</span>
              </div>
              <!-- /.timeline-label -->
              <!-- timeline item -->
              <div>
                <i class="fas fa-sign-out-alt bg-red"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas fa-clock"></i> 12:05</span>
                  <h3 class="timeline-header"><a href="#">{{$bnpl->name}}</a> is logout </h3>

                  <div class="timeline-body">
                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                    weebly ning heekya handango imeem plugg dopplr jibjab, movity
                    jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                    quora plaxo ideeli hulu weebly balihoo...
                  </div>
                </div>
              </div>
              <!-- END timeline item -->
              <!-- timeline item -->
              <div>
                <i class="fas fa-upload bg-green"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas fa-clock"></i> 5 mins ago</span>
                  <h3 class="timeline-header no-border"><a href="#">{{$bnpl->name}}</a> has update password</h3>
                </div>
              </div>
              <!-- END timeline item -->
              <!-- timeline item -->
              <div>
                <i class="fas fa-user-check bg-green"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas fa-clock"></i> 3 mins ago</span>
                  <h3 class="timeline-header no-border"><a href="#">{{$bnpl->name}}</a> has update information</h3>
                </div>
              </div>
              <!-- END timeline item -->
              <!-- timeline item -->
              <div>
                <i class="fas fa-sign-in-alt bg-blue"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas fa-clock"></i> 27 mins ago</span>
                  <h3 class="timeline-header"><a href="#">{{$bnpl->name}}</a> is login</h3>
                  <div class="timeline-body">
                    Welcome back {{$bnpl->name}}
                  </div>
                </div>
              </div>
              <!-- END timeline item -->
              <!-- timeline time label -->
              <div class="time-label">
                <span class="bg-green">3 Jan. 2014</span>
              </div>
              <!-- /.timeline-label -->
              <!-- timeline item -->
              <div>
                <i class="fa fa-camera bg-purple"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas fa-clock"></i> 2 days ago</span>
                  <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>
                  <div class="timeline-body">
                    <img src="https://placehold.it/150x100" alt="...">
                    <img src="https://placehold.it/150x100" alt="...">
                    <img src="https://placehold.it/150x100" alt="...">
                    <img src="https://placehold.it/150x100" alt="...">
                    <img src="https://placehold.it/150x100" alt="...">
                  </div>
                </div>
              </div>
              <!-- END timeline item -->
              <!-- timeline item -->
              <!-- END timeline item -->
              <div>
                <i class="fas fa-clock bg-gray"></i>
              </div>
            </div>
          </div>
          <!-- /.col -->
        </div>
      </div>
      <!-- /.timeline -->

    </section>
                </div>
                <div class="card-footer">
                <a href="{{ URL::previous()}}" class="btn btn-primary">Back</a>
                </div>
                </form>
              </div>
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
    </section>
    <!-- /.content -->

        </div>
    </div>

</div>




{{-- Minimal --}}
<!-- <x-adminlte-input name="name" type="text" placeholder="" label="Name" fgroup-class="col-md-6" disable-feedback value="{{ $bnpl->name }}"/> -->
@stop 
