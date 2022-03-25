@extends('layouts.app')
@section('title', 'Department')

@section('content_header')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Department Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Department</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
@endsection
@section('content')
<section class="content">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Details</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <!-- Post -->
                    <table id="example1" class="table table-bordered table-striped">
                    <div class="tab-pane" id="settings">
                    <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label">Name :</label>
                        <div class="col-sm-10">
                          <p type="text" class="form-control" id="name" placeholder="">{{$department->name}}</p>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label">Phone :</label>
                        <div class="col-sm-10">
                          <p type="text" class="form-control" id="phone" placeholder="">{{$department->phone}}</p>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label">Website :</label>
                        <div class="col-sm-10">
                          <p type="text" class="form-control" id="website" placeholder="">{{$department->website}}</p>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label">Email :</label>
                        <div class="col-sm-10">
                          <p type="text" class="form-control" id="email" placeholder="">{{$department->email}}</p>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label"> Address :</label>
                        <div class="col-sm-10">
                          <p type="text" class="form-control" id="address" placeholder="">{{$department->address}}</p>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label"> Description :</label>
                        <div class="col-sm-10">
                          <p type="text" class="form-control" id="description" placeholder="">{{$department->description}}</p>
                        </div>
                      </div>
                    </form> 
                    <!-- /.post -->
                  </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
</section>
@endsection
 
