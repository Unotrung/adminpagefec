@extends('layouts.app')

@section('title', 'Edit Provider')

@php
use App\Models\Provider; 
$provider = Provider::find($providers);
@endphp
@section('css')
<link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.min.css">
@stop
@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Providers</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('providers.update', 'id='.$providers)}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Name Provider</label>
                    <div class="col-sm-10">
                      <input type="String" class="form-control" name="name" placeholder="Name Provider" value="{{$provider->provider}}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                      <input type="String" class="form-control" name="address" placeholder="address" value="{{$provider->address}}">
                    </div>
                  </div>
                  <input type="hidden" class="form-control" name="Image_Create" placeholder="Image_create" value="{{$provider->Image}}">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Image</label>
                    <div class="col-sm-10">
                      <img class="col-md-10 fvalue" src="{{ asset("./ImagesProvider/$provider->Image") }} " alt="">
                        <label for="file_Edit_News" class="btn btn-primary col-md-10 fvalue">Change image</label>
                        <input id="file_Edit_News" name="Img_Edit" placeholder="Image" style="visibility:hidden;" type="file">
                    </div>
                  </div>
                </div>
                {{-- Save Button --}}
                <button type="submit" class="btn btn-success btn-user btn-block">
                    Update
                </button>
            </form>
        </div>
    </div>
</div>


@endsection