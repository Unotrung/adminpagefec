@extends('layouts.app')

@section('title', 'Add Notifications')
@section('css')
<link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.min.css">
@stop

@section('content_header')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Notifications</h1>
        <a href="{{route('notifications.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
    </div>
@stop
@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add Notifications</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('notifications.store')}}">
                @csrf
                <!-- <div class="form-group row"> -->
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Type Notification</label>
                        <div class="col-sm-10">
                            <select class="form-control form-control-user @error('type_notic') is-invalid @enderror" name="type_notic">
                                <option value="Repayment" selected="selected">Repayment</option>
                                <option value="Payment" value="web" >Payment</option>
                                <option value="Special" value="web" >Special offers</option>
                            </select>
                            
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                        <input type="string" class="form-control" name="Title" placeholder="Title" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                        <input type="string" class="form-control" name="Description" placeholder="Description" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Content</label>
                        <textarea name="content" id="summernote" cols="100" rows="10"></textarea>
                    </div>
                    {{-- <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Image</label>
                        <div class="col-sm-10">
                            <div id="img-preview"></div>
                            <label for="file_Edit_News" class="btn btn-primary col-md-5 fvalue">Thêm ảnh</label>
                            <input id="file_Edit_News" name="Img_Create" placeholder="Image" style="visibility:hidden;" type="file">
                        </div>
                    </div> --}}
                <!-- </div> -->

                {{-- Save Button --}}
                <button type="submit" class="btn btn-success btn-user btn-block" style="width:20%; display:block; margin: 0 auto;">
                    Save
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
      $('#summernote').summernote();
    })
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
          imgPreview.innerHTML = '<img class=" col-md-5 fvalue" src="' + this.result + '" />';
        });    
      }
    }
</script>
@stop