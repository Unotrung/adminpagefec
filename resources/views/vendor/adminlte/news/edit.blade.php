@extends('layouts.app')

@section('title', 'Edit News')

@php
use App\Models\News; 
$new = News::find($news);
@endphp
@section('css')
<link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.min.css">
@stop
@section('content_header')
    <!-- DataTales Example -->
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h6 class="m-0 font-weight-bold text-primary">Edit News</h6>
            <a href="{{route('news.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" ><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
        </div>
        @stop
        @section('content')
        <div class="card shadow mb-4">
            <form method="POST" action="{{route('news.update', 'id='.$news)}}">
                @csrf
                @method('POST')
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                      <input type="String" class="form-control" name="Title_Edit" placeholder="Title" value="{{$new->Title}}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                    
                      <textarea type="String" class="form-control" name="Description_Edit" id="summer_descrip" >
                      {!!$new->Description!!}
                      </textarea>
                    </div>
                  </div>
                {{-- Save Button --}}
                <button type="submit" class="btn btn-success btn-user btn-block" style="width:20%; display:block; margin: 0 auto;">
                    Update
                </button>

            </form>
        </div>
    </div>
</div>


@endsection
@section('js')
<script src="../../plugins/summernote/summernote-bs4.min.js"></script>
<script>
    $(function () {
      $('#summer_descrip').summernote();
    })
</script>
@stop