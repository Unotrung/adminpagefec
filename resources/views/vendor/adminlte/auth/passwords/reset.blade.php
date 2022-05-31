@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@php( $password_reset_url = View::getSection('password_reset_url') ?? config('adminlte.password_reset_url', 'password/reset') )

@if (config('adminlte.use_route_url', false))
    @php( $password_reset_url = $password_reset_url ? route($password_reset_url) : '' )
@else
    @php( $password_reset_url = $password_reset_url ? url($password_reset_url) : '' )
@endif

@section('auth_header', __('adminlte::adminlte.password_reset_message'))

@section('auth_body')
    <form action="{{ $password_reset_url }}" method="post">
        @csrf

        {{-- Token field --}}
        <input type="hidden" name="token" value="{{ $token }}">

        {{-- Email field --}}
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ $email }}" placeholder="{{ __('adminlte::adminlte.email') }}" style="display: none;" autofocus>

            <div class="input-group-append" style="display: none;">
                <div class="input-group-text">
                    <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

        {{-- Password field --}}
        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror " 
                   id="password" 
                   placeholder="New Password"  >

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            {{-- @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ 'Please Enter New Password' }}</strong>
                </span>
            @enderror --}}
            
        </div>
        <p class="text-danger" id="check_length"></p>
        {{-- Password confirmation field --}}
        <div class="input-group mb-3">
            <input type="password" name="password_confirmation"
                   class="form-control @error('password') is-invalid @enderror"
                   placeholder="Retype New Password">

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            {{-- @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror --}}
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Confirm password reset button --}}
        <button type="submit" class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}  " id ="button">
            <span class="fas fa-sync-alt"></span>
            {{ __('adminlte::adminlte.reset_password') }}
        </button>

    </form>
@stop
@section('js')
<script>
$(document).ready(function(){
  

  // function hasLowerCase(str) {
  //   return str.toLowerCase() != str;
  // }  

  // function stringContainsNumber(_string) {
  //   return /\d/.test(_string);
  // }

  // $('#password').on('change',function(){
  //   var password = $('#password').val();
  //   if(password.length === 0)
  //   {
  //     document.getElementById("check_length").innerHTML = "";
  //   }
  //   else
  //   {
  //     uppercase = hasLowerCase(password);
  //     number = stringContainsNumber(password);
  //     if((password.length<8 && password.length>0)&&((uppercase == false && number == false)))
  //     {
  //       document.getElementById("check_length").innerHTML = "Passwords need a minimum of 8 characters including 1 uppercase character and 1 number.";
  //     }
  //     else if((password.length<8 && password.length>0)&&((uppercase == true && number == false)))
  //     {
  //       document.getElementById("check_length").innerHTML = "Passwords need a minimum of 8 characters including 1 number.";
  //     }
  //     else if((password.length<8 && password.length>0)&&((uppercase == false && number == true)))
  //     {
  //       document.getElementById("check_length").innerHTML = "Passwords need a minimum of 8 characters including 1 uppercase";
  //     }
  //     else if((password.length<8 && password.length>0)&&((uppercase == true && number == true)))
  //     {
  //       document.getElementById("check_length").innerHTML = "Passwords need a minimum of 8 characters";
  //     }
  //     else if((password.length>8)&&((uppercase == false && number == false)))
  //     {
  //       document.getElementById("check_length").innerHTML = "Passwords need a minimum including 1 uppercase character and 1 number.";
  //     }
  //     else if((password.length>8)&&((uppercase == true && number == false)))
  //     {
  //       document.getElementById("check_length").innerHTML = "Passwords need a minimum including 1 number";
  //     }
  //     else if((password.length>8)&&((uppercase == false && number == true)))
  //     {
  //       document.getElementById("check_length").innerHTML = "Passwords need a minimum including 1 uppercase character";
  //     }
  //     else
  //     {
  //       document.getElementById("check_length").innerHTML = "";
  //     }
  //   }
  // })
});

</script>
@stop