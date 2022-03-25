@extends('layouts.app')

@section('title', 'Edit Notifications')

@php
use App\Models\Notifications; 
$nots = Notifications::find($not);
@endphp
@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Notifications</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('notifications.update', 'id='.$not)}}">
                @csrf
                @method('POST')
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                      <input type="String" class="form-control" name="Title" placeholder="Title" value="{{$nots->Title}}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                      <input type="String" class="form-control" name="Description" placeholder="Description" value="{{$nots->Description}}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword4" class="col-sm-2 col-form-label">Content</label>
                    <div class="col-sm-10">
                      <input type="String" class="form-control" name="Content" placeholder="Content" value="{{$nots->Content}}">
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