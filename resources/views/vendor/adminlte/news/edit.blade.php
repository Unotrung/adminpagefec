@extends('layouts.app')

@section('title', 'Edit News')

@php
use App\Models\News; 
$new = News::find($news);
@endphp
@section('css')
<link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.min.css">
@stop
@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit News</h6>
        </div>
        <div class="card-body">
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
                </div>
                {{-- Save Button --}}
                <button type="submit" class="btn btn-success btn-user btn-block">
                    Update
                </button>
            </form>
            <a href="{{route('news.index')}}" class="btn btn-success btn-user btn-block" style="background-color: #007BFF"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
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