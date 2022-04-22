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


<div class="content">
        <div class="container-fluid">
            
    <!-- Main content -->
    <section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <ul class="nav nav-tabs" id="custom-content-above-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="custom-content-above-home-tab" data-toggle="pill" href="#custom-content-above-home" role="tab" aria-controls="custom-content-above-home" aria-selected="false">General Infomation</a>
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
                <!-- /.card-body -->
                <div class="card-footer">
                <a href="{{ URL::previous()}}" class="btn btn-primary">Back</a>
                  <!-- <button type="submit" class="btn btn-default">Cancel</button> -->
                  <!-- <button type="submit" class="btn btn-info float-right" >Sign in</button> -->
                  <!-- <li class=""><a href="http://127.0.0.1:8000/bnpl" data-toggle="tooltip" data-placement="right" title="Back to Customers"><i class="fa fa-chevron-left"></i>Cancel</a></li> -->
                </div>
                <!-- /.card-footer -->
            </div>
            <!-- /.card -->
                </form>
              </div>
              <div class="tab-pane fade" id="custom-content-above-profile" role="tabpanel" aria-labelledby="custom-content-above-profile-tab">
                <form method=>
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
                <span class="bg-red">24/3/2022</span>
              </div>
              <!-- /.timeline-label -->
              <!-- timeline item -->
              <div>
                <i class="fas fa-sign-out-alt bg-red"></i>
                <div class="timeline-item">
                  {{-- <span class="time"><i class="fas fa-clock"></i> {{$cus->updatedAt}}</span> --}}
                  <h3 class="timeline-header"><a href="#">{{$cus["username"]}}</a> is logout </h3>
                </div>
              </div>
              <!-- END timeline item -->
              <!-- timeline item -->
              <div>
                <i class="fas fa-upload bg-green"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas fa-clock"></i> 5 mins ago</span>
                  <h3 class="timeline-header no-border"><a href="#">{{$cus["username"]}}</a> has update password</h3>
                </div>
              </div>
              <!-- END timeline item -->
              <!-- timeline item -->
              <div>
                <i class="fas fa-user-check bg-green"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas fa-clock"></i> 3 mins ago</span>
                  <h3 class="timeline-header no-border"><a href="#">{{$cus["username"]}}</a> has update information</h3>
                </div>
              </div>
              <!-- END timeline item -->
              <!-- timeline item -->
              <div>
                <i class="fas fa-sign-in-alt bg-blue"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas fa-clock"></i> 27 mins ago</span>
                  <h3 class="timeline-header"><a href="#">{{$cus["username"]}}</a> is login</h3>
                  <div class="timeline-body">
                    Welcome back {{$cus["username"]}}
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
              <div>
                <i class="fas fa-video bg-maroon"></i>

                <div class="timeline-item">
                  <span class="time"><i class="fas fa-clock"></i> 5 days ago</span>

                  <h3 class="timeline-header"><a href="#">Mr. Doe</a> shared a video</h3>

                  <div class="timeline-body">
                    <div class="embed-responsive embed-responsive-16by9">
                      <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/tMWkeBIohBs" allowfullscreen></iframe>
                    </div>
                  </div>
                  <div class="timeline-footer">
                    <a href="#" class="btn btn-sm bg-maroon">See comments</a>
                  </div>
                </div>
              </div>
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
@stop 
