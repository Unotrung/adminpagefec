@extends('layouts.app')
@section('title', 'Edit FAQs')
@section('css')
<link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.min.css">
@stop
@section('content_header')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit FAQs</h1>
        <a href="{{route('faqs.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
    </div>
@stop
@section('content')
    <!-- DataTales Example -->
    <div class="col-md-12">
      <div class="card">
            <div class="card-body">
                  <form method="POST" action="{{route('faqs.update')}}" >
                @csrf
                <input type="hidden" name="id" value="{{$faq->id}}">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Category</label>
                    <div class="col-sm-10">
                      <input type="String" class="form-control" name="Category_Edit" placeholder="Title" value="{{$faq->Category}}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Language</label>
                    <div class="col-sm-10">
                      <input type="String" class="form-control" name="Language_Edit" placeholder="Title" value="{{$faq->Language}}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Question</label>
                    <div class="col-sm-10">
                      <textarea type="String" class="form-control" name="Question_Edit" id="Question_Edit" >
                      {!!$faq->Question!!}
                      </textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Answers</label>
                    <div class="col-sm-10">
                      <textarea type="String" class="form-control" name="Answer_Edit" id="Answer_Edit" >
                      {!!$faq->Answer!!}
                      </textarea>
                    </div>
                  </div>
                  <div data-toggle="modal" data-target="#demoModal" class="btn btn-success btn-user btn-block" style="width:100%">
                    Submit
                  </div>

                  <div class="modal" id="demoModal">
                    <div class="modal-dialog">
                    <div class="modal-content">
                    <!-- Modal Header -->
                        <div class="modal-header">
                        <h4 class="modal-title">Do you want to edit faq?  </h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Yes</button>
                        <button type="button" class="btn" data-dismiss="modal">No</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
            </div>
        </div>
    </div>


@endsection
@section('js')
<script src="../../plugins/summernote/summernote-bs4.min.js"></script>
<script>
    $(function () {
      $('#Answer_Edit').summernote();
    })
    $(function () {
      $('#Question_Edit').summernote();
    })
</script>
@stop
