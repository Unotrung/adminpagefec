@extends('layouts.app')

@section('title', 'FAQs')

@section('content')
<script type="text/javascript" src="//code.jquery.com/jquery-3.6.0.min.js"></script>
  
  <script>
 $(document).ready(function() {
 
    $('.faq_question').click(function() {
 
        if ($(this).parent().is('.open')){
            $(this).closest('.faq').find('.faq_answer_container').animate({'height':'0'},500);
            $(this).closest('.faq').removeClass('open');
 
            }else{
                var newHeight =$(this).closest('.faq').find('.faq_answer').height() +'px';
                $(this).closest('.faq').find('.faq_answer_container').animate({'height':newHeight},500);
                $(this).closest('.faq').addClass('open');
            }
    });
});
</script>
<style>
 
/*FAQS*/
.faq_question {
    margin: 0px;
    padding: 0px 0px 0px 20px;
    display: inline-block;
    cursor: pointer;
    font-weight: bold;
}
 
.faq_answer_container {
    height: 0px;
    overflow: hidden;
    padding: 0px 20px;
}
</style>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">FAQs</h1>
        <a href="{{route('roles.add')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus"></i> Add New
        </a>
    </div>

   
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All FAQs</h6>
            
        </div>
        
        <div class="card-body">
        <div class="faq_container">
            <div class="card faq py-3">
                <h6 class="text-primary faq_question">1. How can I login? </h6>
                    <div class="faq_answer_container">
                        <div class="faq_answer">Answer goes here</div>
                    </div>        
                </div>
            </div>

            <div class="card faq py-3">
                <h6 class="text-primary faq_question">2. How can I read the FAQs? </h6>
                    <div class="faq_answer_container">
                        <div class="faq_answer">Answer goes here</div>
                    </div>        
                </div>
                <div class="card faq py-3">
                <h6 class="text-primary faq_question">3. How can I reset password? </h6>
                    <div class="faq_answer_container">
                        <div class="faq_answer">Answer goes here</div>
                    </div>        
                </div>
            </div>
            </div>
        </div>
</div>
    </div>
</div>



@endsection