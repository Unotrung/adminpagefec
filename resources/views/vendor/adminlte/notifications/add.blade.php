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
    <div class = "row">
        <div class="col-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Add Notifications</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('notifications.store')}}" enctype="multipart/form-data">
                        @csrf
                        <!-- <div class="form-group row"> -->
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-6 col-form-label">Type Notification</label>
                                <div class="col-sm-10">
                                    <select class="form-control form-control-user @error('type_notic') is-invalid @enderror" name="type_notic" id="type_notic">
                                        <option value="" selected="selected">Select Type</option>
                                        <option value="Thanh toán" >Thanh toán</option>
                                        <option value="Tin tức"  >Tin tức</option>
                                        <option value="Giao dịch"  >Giao dịch</option>
                                        <option value="Mã giảm giá"  >Mã giảm giá</option>
                                        <option value="Khác" >Khác</option>
                                    </select>
                                    
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-6 col-form-label">Type Device</label>
                                <div class="col-sm-10">
                                    <select class="form-control form-control-user @error('type_notic') is-invalid @enderror" name="type_device">
                                        <option value="" selected="selected">Select Device</option>
                                        <option value="web"  >Web</option>
                                        <option value="mobile"  >Mobile</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-6 col-form-label">Title</label>
                                <div class="col-sm-10">
                                <input type="string" class="form-control" name="Title" placeholder="Title" id="Title">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-6 col-form-label">Description</label>
                                <div class="col-sm-10">
                                <input type="string" class="form-control" name="Description" placeholder="Description" id="Description" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-6 col-form-label">Content</label>
                                <textarea name="Content_Create" id="summernote" cols="100" rows="10"></textarea>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-6 col-form-label">Image</label>
                                <div class="col-sm-10">
                                    <div id="img-preview"></div>
                                    <label for="file_Edit_News" class="btn btn-primary col-md-5 fvalue">Thêm ảnh</label>
                                    <input id="file_Edit_News" name="Img_Create" placeholder="Image" style="visibility:hidden;" type="file">
                                </div>
                            </div>
                        <!-- </div> -->

                        {{-- Save Button --}}
                        <button type="submit" class="btn btn-success btn-user btn-block" style="width:20%; display:block; margin: 0 auto;">
                            Save
                        </button>

                    </form>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card" style="border-radius: 15px">
                <div class="content-header">
                    <h3>Preview Notification</h3>
                </div>
                <div class="content">
                    <div class="row">
                        <div id="img-previews"></div>
                        <div class="col-8" style="padding: 5%">
                            <h3  id="pre-title"></h3>

                            <div  id="pre-description"></div>
                            <div class="card" id="pre-type" style="
                        "></div>
                        </div>
                    </div>
                </div>
            </div>
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
    const imgPreviews = document.getElementById("img-previews");
    
    chooseFile.addEventListener("change", function () {
      getImgData();
    });
    
    function getImgData() {
      const files = chooseFile.files[0];
      if (files) {
        const fileReader = new FileReader();
        fileReader.readAsDataURL(files);
        fileReader.addEventListener("load", function () {
          imgPreview.innerHTML = '<img class=" col-md-4 fvalue" src="' + this.result + '" />';
        }); 
        fileReader.addEventListener("load", function () {
          imgPreviews.innerHTML = '<img class="" src="' + this.result + '" style="width: 180px;height: 150px;padding:10%"/>';
        });   
      }
    }

    $('#Title').change(function(e)
    {
        
        var title = $('#Title').val();
        if(title == '')
        {
            $("#pre-title").empty();
        }
        else
        {
            $("#pre-title").empty();
            $('#pre-title').append(title);
        }
        console.log(title);
       
    });

    $('#Description').change(function(e)
    {
        var description = $('#Description').val();
        if(description == '')
        {
            $("#pre-description").empty();
        }
        else
        {
            $("#pre-description").empty();
            $('#pre-description').append(description);
        }
        // console.log(description);
        // $('#pre-description').append(description);
    });
    $('#type_notic').change(function(e)
    {
        var type = $('#type_notic').val();
        if(type == '')
        {
            $("#pre-type").empty();
        }
        if(type == 'Thanh toán')
        {
            $("#pre-type").empty();
            $('#pre-type').append(type);
            $("#pre-type").attr('style',  'background: rgb(237, 223, 207);width: 40%;text-align: center;');
        }
        if(type == 'Tin tức')
        {
            $("#pre-type").empty();
            $('#pre-type').append(type);
            $("#pre-type").attr('style',  'background: rgb(198, 238, 246);width: 40%;text-align: center;');
        }
        if(type == 'Giao dịch')
        {
            $("#pre-type").empty();
            $('#pre-type').append(type);
            $("#pre-type").attr('style',  'background: rgb(227, 191, 238);width: 40%;text-align: center;');
        }
        if(type == 'Mã giảm giá')
        {
            $("#pre-type").empty();
            $('#pre-type').append(type);
            $("#pre-type").attr('style',  'background: rgb(228, 189, 187);width: 40%;text-align: center;');
        }
        if(type == 'Khác')
        {
            $("#pre-type").empty();
            $('#pre-type').append(type);
            $("#pre-type").attr('style',  'background: rgb(237, 223, 207);width: 40%;text-align: center;');
        }
        // console.log(type);
        // $('#pre-type').append(type);
    });
</script>
@stop