<!-- caredit.blade.php  -->
<!--  -->
@extends('layouts.app')
@section('title', 'News')
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
            </ul>
            <!-- <div class="tab-custom-content">
              <p class="lead mb-0">"Information BNPL"</p>
            </div> -->
            <div class="tab-content" id="custom-content-above-tabContent">
              <div class="tab-pane fade show active" id="custom-content-above-home" role="tabpanel" aria-labelledby="custom-content-above-home-tab">
                  <!-- Horizontal Form -->
            <div class="card card-info">
              <!-- <div class="card-header">
                <h3 class="card-title">Edit user</h3>
              </div> -->
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                    <div class="col-md-10 fvalue">{{$news->Title}}</div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                    <div class="col-md-10 fvalue">{!!$news->Description!!}</div>
                    
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Content</label>
                    <div class="col-sm-10">
                    <div class="col-md-10 fvalue">{!!$news->Content!!}</div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Author</label>
                    <div class="col-sm-10">
                    <div class="col-md-10 fvalue">{{$news->Author}}</div>
                    </div>
                  </div>
                  <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 col-form-label">URL</label>
                      <div class="col-sm-10">
                      <div class="col-md-10 fvalue">{{$news->URL}} &nbsp; <a style="text-decoration: none; color: white; background-color: rgb(63, 62, 62)"> Get URL</a></div>
                      
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 col-form-label">Images</label>
                      <div class="col-sm-10">
                        <img class="col-md-10 fvalue" src="{{ asset("./ImagesNews/$news->Image") }} " alt="">
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                <a href="http://127.0.0.1:8000/news/index" class="btn btn-primary">Back</a>
                  <!-- <button type="submit" class="btn btn-default">Cancel</button> -->
                  <!-- <button type="submit" class="btn btn-info float-right" >Sign in</button> -->
                  <!-- <li class=""><a href="http://127.0.0.1:8000/bnpl" data-toggle="tooltip" data-placement="right" title="Back to Customers"><i class="fa fa-chevron-left"></i>Cancel</a></li> -->
                </div>
                <!-- /.card-footer -->
            </div>
            <!-- /.card -->
              </div>
            
      <!-- /.timeline -->

    </section>
                </div>
                
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
