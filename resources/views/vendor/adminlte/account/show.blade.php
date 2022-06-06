@extends('layouts.app')
@section('title', 'Account')
@section('css')
<link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
{{-- <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css"> --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" 
   href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
@stop

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
                <div class="fvalue"><label for="inputPassword3" class="col-sm-6 col-form-label">Email:</label><p style="padding-left: 8px;">{{Auth::user()->email}}</p></div>
              </div>

              <div class="col-sm-12">
                <div class="fvalue"><label for="inputPassword3" class="col-sm-6 col-form-label">Division:</label><p style="padding-left: 8px;">{{Auth::user()->division}}</p></div>
              </div>

              <div class="col-sm-12">
                <div class="fvalue"><label for="inputPassword3" class="col-sm-6 col-form-label">Center:</label><p style="padding-left: 8px;">{{Auth::user()->center}}</p></div>
              </div>

              <div class="col-sm-12">
                <div class="fvalue"><label for="inputPassword3" class="col-sm-6 col-form-label">Department:</label><p style="padding-left: 8px;">{{Auth::user()->department}}</p></div>
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
                          @php
                            $date_first = "";
                          @endphp
                          @foreach($timechange as $timechange)
                          @if( Auth::user()->id == $timechange->user_id)
                          @php
                            $date = date('d/m/Y', strtotime($timechange->created_at));
                          @endphp
                            @if($date != $date_first )
                              <div class="time-label">
                                <span class="bg-red"> {{$date}}</span>
                              </div>
                            @endif  
                          @php
                              $date_first = $date;
                            @endphp
                           
                            @if($timechange->type == "Logout")
                            <div>
                              <i class="fas fa-sign-out-alt bg-red"></i>
                              <div class="timeline-item">
                                <span class="time"><i class="fas fa-clock"></i> {{date("Y-m-d H:i:s",(strtotime($timechange->created_at)+ 60*60*7))}}</span>
                                
                                <h3 class="timeline-header"><a href="#"></a> {{ Auth::user()->name }} logged out </h3>
                              </div>
                            </div>
                            
                            @elseif($timechange->type == "Password")
                            <div>
                              <i class="fas fa-upload bg-green"></i>
                              <div class="timeline-item">
                                <span class="time"><i class="fas fa-clock"></i> {{date("Y-m-d H:i:s",(strtotime($timechange->created_at)+ 60*60*7))}}</span>
                                <h3 class="timeline-header no-border"><a href="#"></a>{{ Auth::user()->name }} changed password</h3>
                              </div>
                            </div>
                            
                            @elseif($timechange->type == "Information")
                            <div>
                              <i class="fas fa-user-check bg-green"></i>
                              <div class="timeline-item">
                                <span class="time"><i class="fas fa-clock"></i>{{date("Y-m-d H:i:s",(strtotime($timechange->created_at)+ 60*60*7))}}</span>
                                <h3 class="timeline-header no-border"><a href="#"></a>{{ Auth::user()->name }} updated information</h3>
                              </div>
                            </div>
                            
                            @elseif($timechange->type == "Login")
                            <div>
                              <i class="fas fa-sign-in-alt bg-blue"></i>
                              <div class="timeline-item">
                                <span class="time"><i class="fas fa-clock"></i> {{date("Y-m-d H:i:s",(strtotime($timechange->created_at)+ 60*60*7))}} </span>
                                <h3 class="timeline-header"><a href="#"></a>{{ Auth::user()->name }} logged in</h3>
                                <div class="timeline-body">
                                  Welcome back 
                                </div>
                              </div>
                            </div>
                            @endif
                            @endif
                            @endforeach
                        </div>
                      </div>
                      <!-- /.col -->
                    </div>
                  </div>
                    <!-- Post -->
                    
                    <!-- /.post -->

                    <!-- Post -->
                   
                    <!-- /.post -->
                  {{-- </div>{{Auth::user()->name}} --}}
                 
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">
                    <form class="form-horizontal" method="POST" action="{{route('account.update')}}"> 
                      @csrf
                      <input type="hidden" name="id" value="{{Auth::user()->id}}">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label">Name<span style="color:red;">*</span></label>
                        <div class="col-sm-9">
                          <input type="" class="form-control" id="inputName" placeholder="Name" value="{{Auth::user()->name}}" name="name" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-3 col-form-label">Email<span style="color:red;">*</span></label>
                        <div class="col-sm-9">
                          <input type="email" class="form-control" id="inputEmail" placeholder="Email" value="{{Auth::user()->email}}" name="email">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-3 col-form-label">Division</label>
                        <div class="col-sm-9">
                          <select id="user" class="form-control" name="division">
                            <option value="{{Auth::user()->division}}" selected="">{{Auth::user()->division}}</option>																			
                            @foreach (explode(';',$configdiv) as $configsdiv)		
                            @if($configsdiv!=Auth::user()->division)	
                              <option value="{{$configsdiv}}">{{$configsdiv}}</option>
                            @endif
                            @endforeach
                          </select>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-3 col-form-label">Center</label>
                          <div class="col-sm-9">
                            <select id="user" class="form-control" name="center">
                              <option value="{{Auth::user()->center}}" selected="">{{Auth::user()->center}}</option>																			
                              @foreach (explode(';',$configcen) as $configscen)		
                                @if($configscen!=Auth::user()->center)	
                                  <option value="{{$configscen}}">{{$configscen}}</option>
                                @endif
                              @endforeach
                            </select>
                          </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-3 col-form-label">Department</label>
                        <div class="col-sm-9">
                          <select id="user" class="form-control" name="department">
                            <option value="{{Auth::user()->department}}" selected="">{{Auth::user()->department}}</option>																			
                              @foreach (explode(';',$configdep) as $configsdep)		
                              @if($configsdep!=Auth::user()->department)	
                                <option value="{{$configsdep}}">{{$configsdep}}</option>
                              @endif
                              @endforeach
                          </select>
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-sm-10" >
                          <div  class="btn btn-danger btn-user btn-block" style="width: 20% ;margin: 10px 290px" onClick="btnSubmit(this.value)">Submit </div>
                            <div class="modal" id="confirmModal">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                  <h4 class="modal-title">Do you want to submit? </h4>
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                  <button type="submit" class="btn btn-danger">Yes</button>
                                  <button type="button" class="btn" data-dismiss="modal">No</button>
                                </div>
                                </div>
                            </div>
                            </div>
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
      <script>
        @if(Session::has('success'))
          toastr.options =
          {
            "closeButton" : true,
            "progressBar" : true
          }
              toastr.success("{{ session('success') }}");
          @endif
    
      </script>
    </section>
    <!-- /.content -->
    
  
@stop

@section('js')

<script>
  function btnSubmit(){
    var Email = $("#inputEmail").val();
		var Name = $("#inputName").val();
    console.log(Email.length);
    console.log(Name.length);
    if(Name.length > 0  && Email.length === 0 ){
			toastr["error"]("Please Input Email!")
		}
		if( Name.length === 0  && Email.length > 0 ){
			toastr["error"]("Please Input Name !")
		}
		if( Name.length === 0  && Email.length === 0){
			toastr["error"]("Please Input Name & Email !")
		}
    toastr.options = {
			"closeButton": false,
			"debug": true,
			"newestOnTop": false,
			"progressBar": false,
			"positionClass": "toast-top-right",
			"preventDuplicates": false,
			"onclick": null,
			"showDuration": "300",
			"hideDuration": "1000",
			"timeOut": "5000",
			"extendedTimeOut": "1000",
			"showEasing": "swing",
			"hideEasing": "linear",
			"showMethod": "fadeIn",
			"hideMethod": "fadeOut"
		}
		if(Name.length > 0 && Email.length > 0  )
		{
			// data-toggle="modal" data-target="#confirmModal" 
			$("#confirmModal").modal("show");
		}
  }
</script>
@stop