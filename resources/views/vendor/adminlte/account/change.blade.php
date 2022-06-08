<x-guest-layout>
  <style>
    #error{
      color:red;
    }
  </style>
@extends('layouts.app')
@section('title', 'Account')
@section('content_header')
@section('css')
<link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
{{-- <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css"> --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" 
   href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
@stop
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Change Password</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Change Password</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
@stop
@section('content')
        <!-- Validation Errors -->
       <!-- <x-auth-validation-errors class="mb-4" :errors="$errors" /> -->
       <div class="container-fluid">
       <div class="row">
        
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div class="" style="background-color: rgb(255,255,255);border-left: 1px solid red;padding-left: 60px;width: 50%;float: right;margin-top: 5%;height: 250px;">
                <label style="color:red;padding-right: 220px">*Note</label>
                <label> Your password can only include:</label>
                <h6 > Minimum lower character: 1</h6>
                <h6 > Minimum upper character: 1</h6>
                <h6 > Minimum length: 10 </h6>
                <h6 > Maximum length: 24 </h6>
                <h6> Minimum numeric character: 1 </h6>
                <h6 > Minimum special character: 1 </h6>
              </div>
              <form method="POST" action="{{ route('password.edit') }}" style="width: 50%;float: left;" autocomplete="off">
              @csrf
              <div class="info-form form-group">
                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ csrf_token() }}">

                <!-- Email Address -->
                <div class="mt-4" style="width:60%; display:none;">
                    <x-label for="email" :value="__('Email')" />

                    <x-input id="email" class="block mt-1 w-full" type="text" name="email" value="{{Auth::user()->email}}" required />
                </div>

                <!-- Old Password -->
                <div class="mt-4" style="width:90%; display:block;margin-right: auto;">
                    <x-label for="current_password" :value="__('Current Password')" />

                    <input id="current_password" class="form-control block mt-1 w-full @error('current_password') is-invalid @enderror @error('name') is-invalid @enderror" type="password" name="current_password" autocomplete="new-password" style="border-left: 2px solid red" />
                    <span class="invalid-feedback" role="alert">
                      @error('current_password')
                      <strong>{{ "Current password is not correct" }}</strong>
                      @enderror
                      @error('name')
                      <strong>{{ $message }}</strong>
                      @enderror
                    </span>
                  </div>
                  
                <!-- Password -->
                <div class="mt-4" style="width:90%; display:block;margin-right: auto;">
                    <x-label for="password" :value="__('New Password')" />

                    <input id="password" class="form-control block mt-1 w-full @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="off" style="border-left: 2px solid red"/>
                </div>

                <!-- Confirm Password -->
                <div class="mt-4" style="width:90%; display:block;margin-right: auto;">
                    <x-label for="password" :value="__('Confirm New Password')" />

                    <input id="password" class="form-control block mt-1 w-full @error('password') is-invalid @enderror"
                                        type="password"
                                        name="password_confirmation" required autocomplete="off" style="border-left: 2px solid red"/>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
              <div class="mt-4" style="width:90%; display:block;margin-right: auto;" id="otp_text">
                <div class="row">
                  <div class="col-9" style="margin: 0;padding: 0;">
                    <x-label for="otp" :value="__('OTP')" />
                    
                    <input id="otp" class="form-control block mt-1 w-full " type="text" name="otp" required/> 
                  </div>
                  <div class="col-3" style="margin: 0;padding: 0;padding-top: 32px;padding-left: 5px;">
                    <button type="button" id="sendmail" class="btn btn-success-outline-primary" style="background-color: rgb(23,162,184);color:white;height:40px">Sent OTP</button>
                    {{-- <a href="{{route('password.edit')}}" class="float-sm-right align-items-middle d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                            <i class="fas fa-envelope"></i> Send OTP</a> --}}
                  </div>
                </div>
              </div>
              <div id="error"></div>
              <div class="mt-4" style="width:10%; margin-left: auto;margin-right: auto; " >
                <button type="button" id="sendOTP" class="btn btn-success" style="background-color: gray;border: hidden;" disabled>Continue</button>
                  <x-button style=" visibility:hidden;background-color: green;" id="btnSubmit" disabled>
                      {{ __('Save') }}
                  </x-button> 
              </div>
              
            </form>
          </div>
          </div>
        </div>
    </div>
</div>
</x-guest-layout>
@endsection


@section('js')
<script>
$(document).ready(function(){
  $('#otp_text').hide();

  var otp_value = $('#otp').val();
  console.log("aaaaa"+otp_value);
  $('#current_password').change(function(e)
  {
    var checkpassword = $("input[name^='password_confirmation']").val();
    if(($('#current_password').val().length == 0))
    {
      $('#sendOTP').prop('disabled', true);
      $('#sendOTP').removeAttr("style");
      $("#sendOTP").attr('style',  'background-color:gray; border-color:gray');
    }
    if(($('#current_password').val().length > 0) && ($('#password').val().length > 0) && (checkpassword.length > 0))
    {
      $('#sendOTP').removeAttr("disabled");
      $('#sendOTP').removeAttr("style");
      $("#sendOTP").attr('style',  'background-color:green');
    }
  });

  $("input[name^='password_confirmation']").change(function(e){
    var checkpassword = $("input[name^='password_confirmation']").val();
    console.log(checkpassword);
    if(($('#current_password').val().length > 0) && ($('#password').val().length > 0) && (checkpassword.length > 0))
    {
      $('#sendOTP').removeAttr("disabled");
      $('#sendOTP').removeAttr("style");
      $("#sendOTP").attr('style',  'background-color:green');
    }
    else
    {
      $('#sendOTP').prop('disabled', true);
      $('#sendOTP').removeAttr("style");
      $("#sendOTP").attr('style',  'background-color:gray; border-color:gray');
      // $("#sendOTP").attr('style',  'border-color:gray');
    }
  });

  $('#password').change(function(e)
  {
    var checkpassword = $("input[name^='password_confirmation']").val();
    if(($('#password').val().length == 0))
    {
      $('#sendOTP').prop('disabled', true);
      $('#sendOTP').removeAttr("style");
      $("#sendOTP").attr('style',  'background-color:gray; border-color:gray');
    }
    if(($('#current_password').val().length > 0) && ($('#password').val().length > 0) && (checkpassword.length > 0))
    {
      $('#sendOTP').removeAttr("disabled");
      $('#sendOTP').removeAttr("style");
      $("#sendOTP").attr('style',  'background-color:green');
    }
  });

  $('#otp').change(function(e)
  {
    if($('#otp').val().length == 6){
      $('#btnSubmit').removeAttr("disabled");
      $("#btnSubmit").attr('style',  'background-color:green');
    }
    else
    {
      $("#btnSubmit").attr('style',  'background-color:gray');
    }
    if($('#otp').val() != '')
    {
      $('#sendmail').prop('disabled', true);
    }
    if($('#otp').val() == '')
    {
      $('#sendmail').removeAttr("disabled");
    }
  });

  $("#sendOTP").on("click",function(e){
    e.preventDefault();
    if(validationInput()){
      $('#otp_text').show();
      $('#btnSubmit').attr("style","visibility:visible");
      $("#btnSubmit").attr('style',  'background-color:gray');
      $("#sendOTP").hide();
      $(".info-form").hide();
    }
  });

  $('#sendmail').on("click",function(e){
      $.ajax({
        url: "{{route('password.edit')}}",
        type: 'POST',
        dataType:'json',
        data: {
          "_token": "{{ csrf_token() }}",
        },
        async : false,
        complete : function(){
          console.log("[JQUERY AJAX COMPLETE]");
          toastr["success"]("OTP has been sent to your email")
            toastr.options = {
            "closeButton": false,
            "debug": true,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
          }
        }
        // success: function(){
        //     console.log(data);
        // }
        });
  });

  function validationInput(){
    var resBool = false;
    $.ajax({
                    url: "{{route('password.check')}}",
                    type: 'POST',
                    dataType:'json',
                    async: false,
                    data: $("form").serialize(),
                    error:function(error){
                      if(error.status != 200){
                        var text = "";
                        if(error.responseJSON.errors.password != undefined){
                          error.responseJSON.errors.password.forEach(element => {
                            text += element+"</br>";
                          });
                          $("#error").html(text);
                        }else{
                          error.responseJSON.errors.current_password.forEach(element => {
                            text += element+"</br>";
                          });
                          $("#error").html(text);
                        }
                        resBool = false;
                      }
                    },
                    success:function(res,bool){
                      $("#error").html("");
                      resBool = true;
                    },
                    complete: function(){
                      console.log("complete : ", resBool);
                    }
                });
                return resBool;
  }

});

</script>
@stop