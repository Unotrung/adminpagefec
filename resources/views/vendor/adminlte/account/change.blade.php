
<x-guest-layout>
@extends('layouts.app')
@section('title', 'Account')
@section('content_header')
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
                <div class="mt-4" style="width:60%; display:block;margin-left: auto;margin-right: auto;">
                    <x-label for="current_password" :value="__('Current Password')" />

                    <input id="current_password" class="form-control block mt-1 w-full @error('current_password') is-invalid @enderror @error('name') is-invalid @enderror" type="password" name="current_password" autocomplete="new-password" />
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
                <div class="mt-4" style="width:60%; display:block;margin-left: auto;margin-right: auto;">
                    <x-label for="password" :value="__('New Password')" />

                    <input id="password" class="form-control block mt-1 w-full @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="off"/>
                </div>

                <!-- Confirm Password -->
                <div class="mt-4" style="width:60%; display:block;margin-left: auto;margin-right: auto;">
                    <x-label for="password" :value="__('Confirm New Password')" />

                    <input id="password" class="form-control block mt-1 w-full @error('password') is-invalid @enderror"
                                        type="password"
                                        name="password_confirmation" required autocomplete="off"/>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
              <div class="mt-4" style="width:60%; display:block;margin-left: auto;margin-right: auto;" id="otp_text">
                <div class="row">
                  <div class="col-7" style="margin: 0;padding: 0;">
                    <x-label for="otp" :value="__('OTP')" />
                    
                    <input id="otp" class="form-control block mt-1 w-full " type="text" name="otp" required/> 
                  </div>
                  <div class="col-5" style="margin: 0;padding: 0;padding-top: 32px;padding-left: 5px;">
                    <button type="button" id="sendmail" class="btn btn-success-outline-primary" style="background-color: rgb(23,162,184);color:white;height:40px">Sent OTP</button>
                    {{-- <a href="{{route('password.edit')}}" class="float-sm-right align-items-middle d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                            <i class="fas fa-envelope"></i> Send OTP</a> --}}
                  </div>
                </div>
              </div>
              
              <div class="mt-4" style="width:10%; margin-left: auto;margin-right: auto; " >
                <button type="button" id="sendOTP" class="btn btn-success" style="background-color: gray;border: hidden;" disabled>Save</button>
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
  if(($('#current_password').val().length > 0) && ($('#password').val().length > 0))
    {
      $('#sendOTP').removeAttr("disabled");
      $('#sendOTP').removeAttr('style','background-color');
      $("#sendOTP").attr('style',  'background-color:green');
    }
  });

  $('#password').change(function(e)
  {
  if(($('#current_password').val().length > 0) && ($('#password').val().length > 0))
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
      $("#btnSubmit").attr('style',  'background-color:black');
    }
    if($('#otp').val() != '')
    {
      $('#sendmail').hide();
    }
    if($('#otp').val() == '')
    {
      $('#sendmail').show();
    }
  });

  $("#sendOTP").on("click",function(e){
    $('#otp_text').show();
    $('#btnSubmit').attr("style","visibility:visible");
    $("#btnSubmit").attr('style',  'background-color:black');
    $("#sendOTP").hide();
    $(".info-form").hide();
  });

  $('#sendmail').on("click",function(e){
      $.ajax({
        url: "{{route('password.edit')}}",
        type: 'POST',
        dataType:'json',
        data: {
          "_token": "{{ csrf_token() }}",
        },
        success: function(result){
                     console.log(result);
                  }
        });
  })

});

</script>
@stop