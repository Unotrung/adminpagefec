@extends('layouts.app')

@section('title', 'News')

@section('content_header')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">News</h1>
        <a href="{{route('roles.add')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus"></i> Add New
        </a>
    </div>
@stop
@section('content')   
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All News</h6>
        </div>
        <div class="card-body">
            
            <!-- Page Content -->
<div class="container">

<!-- Portfolio Item Heading -->
<h1 class="my-4">Lasted News
  <small id="date"></small><script>
  var today = new Date();
  var date = today.getDate()+'-'+'0'+(today.getMonth()+1)+'-'+today.getFullYear();
  document.getElementById("date").innerHTML = date;
  </script>
</h1>

<!-- Portfolio Item Row -->
<div class="row">

  <div class="col-md-8">
    <img class="img-fluid" src="https://via.placeholder.com/750x500" alt="">
  </div>

  <div class="col-md-4">
    <h3 class="my-3">News Description</h3>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae. Sed dui lorem, adipiscing in adipiscing et, interdum nec metus. Mauris ultricies, justo eu convallis placerat, felis enim.</p>
    <h3 class="my-3">News Details</h3>
    <ul>
      <li>Lorem Ipsum</li>
      <li>Dolor Sit Amet</li>
      <li>Consectetur</li>
      <li>Adipiscing Elit</li>
    </ul>
  </div>

</div>
<!-- /.row -->

<!-- Related Projects Row -->
<h3 class="my-4">Related News</h3>

<div class="row">

  <div class="col-md-3 col-sm-6 mb-4">
    <a href="#">
          <img class="img-fluid" src="https://via.placeholder.com/500x300" alt="">
        </a>
  </div>

  <div class="col-md-3 col-sm-6 mb-4">
    <a href="#">
          <img class="img-fluid" src="https://via.placeholder.com/500x300" alt="">
        </a>
  </div>

  <div class="col-md-3 col-sm-6 mb-4">
    <a href="#">
          <img class="img-fluid" src="https://via.placeholder.com/500x300" alt="">
        </a>
  </div>

  <div class="col-md-3 col-sm-6 mb-4">
    <a href="#">
          <img class="img-fluid" src="https://via.placeholder.com/500x300" alt="">
        </a>
  </div>

</div>
<!-- /.row -->

</div>
<!-- /.container -->

        </div>
    </div>

</div>


@endsection