@extends('layouts.app')

@section('title', 'Promotions')

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
 /*Promotions*/
 .coupon {
  border: 5px dotted #bbb; /* Dotted border */
  width: 80%;
  border-radius: 15px; /* Rounded border */
  margin: 0 auto; /* Center the coupon */
  max-width: 600px;
}

.container {
  padding: 2px 16px;
  background-color: #f1f1f1;
}

.promo {
  background: #ccc;
  padding: 3px;
}

.expire {
  color: red;
}

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
        <h1 class="h3 mb-0 text-gray-800">Promotions</h1>
        <a href="{{route('roles.add')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus"></i> Add New
        </a>
    </div>

   
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Promotions</h6>
        </div>
        <div class="card-body">
        <div class="faq_container">
            <div class="card faq py-3">
                <h6 class="text-primary faq_question">January 2022 </h6>
                    <div class="faq_answer_container">
                        <div class="faq_answer">1. Hot Deal
                        <div class="coupon">
  <div class="container">
    <h3>Hot Deal</h3>
  </div>
  <img src="https://yb4ke1guf9g32qn4pnt1k17m-wpengine.netdna-ssl.com/wp-content/uploads/2019/01/deal-sites.jpg" alt="Avatar" style="width:100%;">
  <div class="container" style="background-color:white">
    <h2><b>20% OFF YOUR PURCHASE</b></h2>
    <p>Lorem ipsum..</p>
  </div>
  <div class="container">
    <p>Use Promo Code: <span class="promo">BOH232</span></p>
    <p class="expire">Expires: Jan 03, 2022</p>
  </div>
</div>
</div>
                    </div>        
                </div>
            </div>

            <div class="card faq py-3">
                <h6 class="text-primary faq_question">February 2022 </h6>
                    <div class="faq_answer_container">
                        <div class="faq_answer">Answer goes here</div>
                    </div>        
                </div>
                <div class="card faq py-3">
                <h6 class="text-primary faq_question">March 2022 </h6>
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