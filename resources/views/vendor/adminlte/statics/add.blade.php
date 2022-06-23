@extends('layouts.app')

@section('title', 'Add Statics Page')
@section('css')
<link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.min.css">

<!-- include summernote css/js-->
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.js"></script>
@stop
@section('content_header')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Statics Page</h1>
        <a href="{{route('statics.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
    </div>
@stop
@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        {{-- <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add Statics Page</h6>
        </div> --}}
        <div class="card-body">
            <form method="POST" action="{{route('statics.store')}}" enctype="multipart/form-data">
                @csrf
                <!-- <div class="form-group row"> -->
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Page name</label>
                        <div class="col-sm-10">
                        <select type="string" class="form-control" name="Pagename_Create" placeholder="Pagename" >
                            <option></option>
                            <option value="1" >Hướng dẫn chụp ảnh chân dung</option>
                            <option >Hướng dẫn chụp ảnh CCCD/CMND</option>
                            <option >Lỗi 404</option>
                            <option >Điều khoản sử dụng</option>
                            <option >Chính sách</option>
                            <option >Cách thức hoạt động</option>
                            <option >Thanh toán lãi suất 0%</option>
                            <option >Đăng ký chỉ trong 2 phút</option>
                            <option >Trải nghiệm mua sắm không giới hạn</option>
                            <option >Cơ hội nhận ưu đãi hoàn tiền chỉ trong 1 ngày</option>
                          </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Type</label>
                        <div class="col-sm-10">
                            <select type="string" class="form-control" name="Type_Create" placeholder="Type" >
                                <option ></option>
                                <option value="1" >Hướng dẫn</option>
                                <option >Lỗi</option>
                                <option >Bài viết</option>
                                <option >Mua trước trả sau cùng VOOLO</option>
                              </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                        <input type="string" class="form-control" name="Title_Create" placeholder="Title" >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                            <textarea name="Description_Create" id="summernote" cols="100" rows="10">Place <em>some</em> <u>text</u> <strong>here</strong></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Post</label>
                        <div class="col-sm-10">
                            <textarea name="Post_Create" id="summernote1" cols="100" rows="10">Place <em>some</em> <u>text</u> <strong>here</strong></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Language</label>
                        <div class="col-sm-10">
                        {{-- <input type="string" class="form-control" name="Language_Create" placeholder="Language" > --}}
                        {{-- <form action="#"> --}}
                            <select type="string" class="form-control" name="Language_Create" placeholder="Language" >
                              <option >Choose Language</option>
                              <option >VNI</option>
                              <option >EN</option>
                            </select>
                      {{-- </form> --}}
                        </div>
                    </div>
                {{-- Save Button --}}
                <button type="submit" class="btn btn-success btn-user btn-block" style="width: 100px;margin: auto;">
                    Submit
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
    $(function () {
      $('#summernote1').summernote();
    })
</script>



@stop
