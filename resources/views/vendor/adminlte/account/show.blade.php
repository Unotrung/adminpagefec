@extends('layouts.app')
@section('title', 'Account')

@section('content_header')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Account Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Account Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
@stop

@section('content')
  @php
  use App\Models\Configuration;
      $config = Configuration::All();
      $configdiv = $config[0]->division;
      $configcen = $config[0]->center;
      $configdep = $config[0]->department;
  @endphp
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-4">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="../../dist/img/user.png"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

                <p class="text-muted text-center">{{ Auth::user()->tittle }}</p>

              </div>

            
              <!-- /.card-body -->

              <div class="col-sm-12">
                <div class="fvalue"><label for="inputPassword3" class="col-sm-4 col-form-label">Email:</label>{{Auth::user()->email}}</div>
              </div>

              <div class="col-sm-12">
                <div class="fvalue"><label for="inputPassword3" class="col-sm-4 col-form-label">Division:</label>{{Auth::user()->division}}</div>
              </div>

              <div class="col-sm-12">
                <div class="fvalue"><label for="inputPassword3" class="col-sm-4 col-form-label">Center:</label>{{Auth::user()->center}}</div>
              </div>

              <div class="col-sm-12">
                <div class="fvalue"><label for="inputPassword3" class="col-sm-4 col-form-label">Department:</label>{{Auth::user()->department}}</div>
              </div>

            </div>
            <!-- /.card -->

            <!-- About Me Box -->          
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-8">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Edit Information</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <!-- Post -->
                    <!-- /.post -->
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
                  {{-- <h3 class="timeline-header"><a href="#"></a> {{ Auth::user()->name }} is logout </h3> --}}
                  <h3 class="timeline-header"><a href="#"></a> {{ Auth::user()->name }} is logout </h3>
                </div>
              </div>
              <!-- END timeline item -->
              <!-- timeline item -->
              <div>
                <i class="fas fa-upload bg-green"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas fa-clock"></i> 5 mins ago</span>
                  <h3 class="timeline-header no-border"><a href="#"></a>{{ Auth::user()->name }} has update password</h3>
                </div>
              </div>
              <!-- END timeline item -->
              <!-- timeline item -->
              <div>
                <i class="fas fa-user-check bg-green"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas fa-clock"></i> 3 mins ago</span>
                  <h3 class="timeline-header no-border"><a href="#"></a>{{ Auth::user()->name }} has update information</h3>
                </div>
              </div>
              <!-- END timeline item -->
              <!-- timeline item -->
              <div>
                <i class="fas fa-sign-in-alt bg-blue"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas fa-clock"></i> 27 mins ago</span>
                  <h3 class="timeline-header"><a href="#"></a>{{ Auth::user()->name }} is login</h3>
                  <div class="timeline-body">
                    Welcome back 
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.col -->
        </div>
                    <!-- Post -->
                    
                    <!-- /.post -->

                    <!-- Post -->
                   
                    <!-- /.post -->
                  </div>
                 
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">
                    <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name<span style="color:red;">*</span></label>
                        <div class="col-sm-10">
                          <input type="" class="form-control" id="inputName" placeholder="Name" value="{{Auth::user()->name}}" name="name" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email<span style="color:red;">*</span></label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail" placeholder="Email" value="{{Auth::user()->email}}" name="email">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Division<span style="color:red;">*</span></label>
                        <div class="col-sm-10">
                          <select id="user" class="form-control" name="division">
                            <option value="" selected="">{{Auth::user()->division}}</option>																			
                            @foreach (explode(';',$configdiv) as $configsdiv)		
                            @if($configsdiv!=Auth::user()->division)	
                              <option value="{{$configsdiv}}">{{$configsdiv}}</option>
                            @endif
                            @endforeach
                          </select>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Center<span style="color:red;">*</span></label>
                        <div class="col-sm-10">
                          <select id="user" class="form-control" name="center">
                            <option value="" selected="">{{Auth::user()->center}}</option>																			
                            @foreach (explode(';',$configcen) as $configscen)		
                            @if($configscen!=Auth::user()->center)	
                              <option value="{{$configscen}}">{{$configscen}}</option>
                            @endif
                            @endforeach
                          </select>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Department<span style="color:red;">*</span></label>
                        <div class="col-sm-10">
                          <select id="user" class="form-control" name="department">
                            <option value="" selected="">{{Auth::user()->department}}</option>																			
                              @foreach (explode(';',$configdep) as $configsdep)		
                              @if($configsdep!=Auth::user()->department)	
                                <option value="{{$configsdep}}">{{$configsdep}}</option>
                              @endif
                              @endforeach
                          </select>
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    
  
@stop

@section('js')


@stop