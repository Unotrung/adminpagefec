@extends('layouts.app')

@section('title', 'Edit News')

@section('css')
<link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.min.css">
@stop
@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit News</h6>
        </div>
        @stop
        @section('content')
        <div class="card shadow mb-4">
            <form method="POST" action="{{route('news.update')}}">
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
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                      <input type="String" class="form-control" name="Description_Edit" placeholder="Title" value="{{$new->Description}}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Content</label>
                    <div class="col-sm-10">
                      <textarea type="String" class="form-control" name="Content_Edit" id="summer_descrip" >
                      {!!$new->Content!!}
                      </textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Author</label>
                    <div class="col-sm-10">
                      <input type="String" class="form-control" name="Author_Edit" placeholder="Title" value="{{$new->Author}}">
                    </div>
                  </div> 
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">URL</label>
                    <div class="col-sm-10">
                      <input type="String" class="form-control" name="Url_Edit" placeholder="Title" value="{{$new->URL}}">
                    </div>
                  </div>
                  <input type="hidden" class="form-control" name="Image_Create" placeholder="Image_create" value="{{$new->Image}}">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Image</label>
                    <div class="col-sm-10">
                      <div id="img-preview"><img class=" col-md-10 fvalue" src="{{ asset("./ImagesNews/$new->Image") }} " alt=""></div>
                      
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
<script>
const chooseFile = document.getElementById("file_Edit_News");
const imgPreview = document.getElementById("img-preview");

chooseFile.addEventListener("change", function () {
  getImgData();
});

function getImgData() {
  const files = chooseFile.files[0];
  if (files) {
    const fileReader = new FileReader();
    fileReader.readAsDataURL(files);
    fileReader.addEventListener("load", function () {
      imgPreview.innerHTML = '<img class=" col-md-10 fvalue" src="' + this.result + '" />';
    });    
  }
}
</script>

@endsection
@section('js')
<script src="../../plugins/summernote/summernote-bs4.min.js"></script>
<script>
    $(function () {
      $('#summer_descrip').summernote();
    })
</script>
@stop